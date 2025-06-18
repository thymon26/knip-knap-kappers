<?php
require_once 'db.php';

// Openingstijden per dag (zelfde als index.php)
$openingstijden = [
    'maandag'    => ['09:00', '18:00'],
    'dinsdag'    => ['09:00', '18:00'],
    'woensdag'   => ['09:00', '18:00'],
    'donderdag'  => ['09:00', '20:00'],
    'vrijdag'    => ['09:00', '18:00'],
    'zaterdag'   => ['09:00', '16:00'],
    'zondag'     => [null, null], // gesloten
];

// Functie om dagnaam te krijgen
function dagnaam($date) {
    $dagen = ['zondag','maandag','dinsdag','woensdag','donderdag','vrijdag','zaterdag'];
    return $dagen[date('w', strtotime($date))];
}

// Functie om tijdsloten te genereren
function tijdsloten($dag, $datum, $pdo) {
    global $openingstijden;
    $slots = [];
    if (!isset($openingstijden[$dag]) || !$openingstijden[$dag][0]) return [];
    $start = strtotime($datum . ' ' . $openingstijden[$dag][0]);
    $end   = strtotime($datum . ' ' . $openingstijden[$dag][1]);
    for ($t = $start; $t < $end; $t += 1800) { // 1800 sec = 30 min
        $tijd = date('H:i', $t);
        // Check aantal reserveringen voor dit slot
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM reserveringen WHERE datum = ? AND tijd = ?");
        $stmt->execute([$datum, $tijd]);
        $count = $stmt->fetchColumn();
        $vol = ($count >= 2);
        $slots[] = ['tijd' => $tijd, 'vol' => $vol];
    }
    return $slots;
}

// Mailer (zelfde als checkout.php)
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$success = false;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = trim($_POST['naam'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $datum = $_POST['datum'] ?? '';
    $tijd = $_POST['tijd'] ?? '';
    $service = $_POST['service'] ?? '';

    // Validatie
    if (!$naam || !$email || !$datum || !$tijd || !$service) {
        $error = "Vul alle velden in.";
    } else {
        $dag = dagnaam($datum);
        if (!isset($openingstijden[$dag]) || !$openingstijden[$dag][0]) {
            $error = "Op deze dag zijn we gesloten.";
        } else {
            // Check of tijd binnen openingstijden valt
            $start = strtotime($openingstijden[$dag][0]);
            $end   = strtotime($openingstijden[$dag][1]);
            $tijdSec = strtotime($tijd);
            if ($tijdSec < $start || $tijdSec >= $end) {
                $error = "Kies een tijd binnen de openingstijden.";
            } else {
                // Check of er al 2 reserveringen zijn voor dit slot
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM reserveringen WHERE datum = ? AND tijd = ?");
                $stmt->execute([$datum, $tijd]);
                if ($stmt->fetchColumn() >= 2) {
                    $error = "Dit tijdslot is al vol. Kies een ander tijdslot.";
                } else {
                    // Opslaan
                    $stmt = $pdo->prepare("INSERT INTO reserveringen (naam, email, service, datum, tijd) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$naam, $email, $service, $datum, $tijd]);
                    $success = true;

                    // Mail sturen
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host       = 'webreus.email';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'noreply@badeendensoep.nl';
                        $mail->Password   = 'Thym3n2oo8!';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port       = 587;
                        $mail->setFrom('noreply@badeendensoep.nl', 'Knip Knap Kappers');
                        $mail->addAddress($email, $naam);
                        $mail->isHTML(true);
                        $mail->Subject = 'Bevestiging van je reservering bij Knip Knap Kappers';
                        $mail->Body    = "<h2>Reserveringsbevestiging</h2>
                        <p>Beste $naam,</p>
                        <p>Je reservering is bevestigd voor <strong>" . date('d-m-Y', strtotime($datum)) . "</strong> om <strong>$tijd</strong>.</p>
                        <p><strong>Behandeling:</strong> " . htmlspecialchars($service) . "</p>
                        <p>We zien je graag bij Knip Knap Kappers!</p>";
                        $mail->send();
                    } catch (Exception $e) {
                        $error = "Reservering opgeslagen, maar mail kon niet worden verstuurd: {$mail->ErrorInfo}";
                    }
                }
            }
        }
    }
}

// Voor het formulier: standaard vandaag, of eerstvolgende open dag
$defaultDate = date('Y-m-d');
$dag = dagnaam($defaultDate);
$maxDays = 14; // max 2 weken vooruit boeken
for ($i = 0; $i < $maxDays; $i++) {
    $checkDate = date('Y-m-d', strtotime("+$i days"));
    $checkDag = dagnaam($checkDate);
    if (isset($openingstijden[$checkDag]) && $openingstijden[$checkDag][0]) {
        $defaultDate = $checkDate;
        break;
    }
}

$services = [
    "Knippen Dames",
    "Knippen Heren",
    "Baby/Kinderen",
    "Verven",
    "Kleurspoeling",
    "Highlights",
    "Balayage",
    "Blonderen",
    "Styling",
    "Verzorging",
    "Permanent"
];
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Reserveren - Knip Knap Kappers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f6f6f6; }
        .reserveren-container {
            max-width: 500px;
            margin: 3rem auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(191,160,70,0.10);
            padding: 2.5rem 2rem 2rem 2rem;
        }
        .form-label { font-weight: 600; }
        .btn-primary {
            background: #bfa046;
            border: none;
        }
        .btn-primary:hover {
            background: #a68b2d;
        }
        .slot-vol {
            color: #bbb;
            text-decoration: line-through;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<div class="reserveren-container">
    <h1 class="mb-4">Afspraak maken</h1>
    <?php if ($success): ?>
        <div class="alert alert-success">
            Je reservering is geplaatst en een bevestiging is verstuurd naar je e-mailadres.
        </div>
        <a href="index.php" class="btn btn-primary">Terug naar de homepage</a>
    <?php else: ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" id="reservering-form">
            <div class="mb-3">
                <label for="naam" class="form-label">Naam</label>
                <input type="text" class="form-control" id="naam" name="naam" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mailadres</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="service" class="form-label">Behandeling / Service</label>
                <select class="form-select" id="service" name="service" required>
                    <option value="">Kies een behandeling...</option>
                    <?php foreach ($services as $srv): ?>
                        <option value="<?= htmlspecialchars($srv) ?>"><?= htmlspecialchars($srv) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="datum" class="form-label">Datum</label>
                <input type="date" class="form-control" id="datum" name="datum"
                    min="<?= $defaultDate ?>"
                    max="<?= date('Y-m-d', strtotime("+13 days", strtotime($defaultDate))) ?>"
                    value="<?= $defaultDate ?>" required>
            </div>
            <div class="mb-3">
                <label for="tijd" class="form-label">Tijd</label>
                <select class="form-select" id="tijd" name="tijd" required>
                    <option value="">Kies een tijd...</option>
                    <?php
                    $slots = tijdsloten(dagnaam($defaultDate), $defaultDate, $pdo);
                    foreach ($slots as $slot) {
                        $disabled = $slot['vol'] ? 'disabled class="slot-vol"' : '';
                        echo "<option value=\"{$slot['tijd']}\" $disabled>{$slot['tijd']}" . ($slot['vol'] ? ' (vol)' : '') . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-lg">Reserveren</button>
        </form>
    <?php endif; ?>
</div>
<script>
const dateInput = document.getElementById('datum');
dateInput.addEventListener('input', function() {
    // 0 = zondag, 6 = zaterdag
    const d = new Date(this.value);
    if (d.getDay() === 0) {
        this.setCustomValidity('Zondagen zijn niet beschikbaar.');
        this.value = '';
    } else {
        this.setCustomValidity('');
    }
});

// Blokkeer zondagen bij het openen van de kalender (optioneel, visueel)
dateInput.addEventListener('keydown', function(e) {
    setTimeout(() => {
        if (this.value) {
            const d = new Date(this.value);
            if (d.getDay() === 0) {
                this.value = '';
            }
        }
    }, 10);
});
</script>
<?php
// AJAX endpoint voor tijdsloten
if (isset($_GET['slots']) && $_GET['datum']) {
    header('Content-Type: application/json');
    $dag = dagnaam($_GET['datum']);
    echo json_encode(tijdsloten($dag, $_GET['datum'], $pdo));
    exit;
}
?>
</body>
</html>