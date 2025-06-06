<?php
require 'db.php';

// Laad PHPMailer
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Haal winkelwagen uit cookie
$cart = [];
if (isset($_COOKIE['cart'])) {
    $cart = json_decode($_COOKIE['cart'], true);
}

// Verwerk bestelling
$success = false;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = trim($_POST['naam'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $straat = trim($_POST['straat'] ?? '');
    $woonplaats = trim($_POST['woonplaats'] ?? '');
    $postcode = trim($_POST['postcode'] ?? '');
    $huisnummer = trim($_POST['huisnummer'] ?? '');
    $toevoeging = trim($_POST['toevoeging'] ?? '');

    if (!$naam || !$email || !$straat || !$woonplaats || !$postcode || !$huisnummer || empty($cart)) {
        $error = "Vul alle velden in en zorg dat je winkelwagen niet leeg is.";
    } else {
        $adres = "$straat $huisnummer $toevoeging, $postcode $woonplaats";

        // Maak order-overzicht
        $orderHtml = "<h2>Bestelbevestiging</h2>";
        $orderHtml .= "<p>Bedankt voor je bestelling, $naam!</p>";
        $orderHtml .= "<p><strong>Adres:</strong> " . htmlspecialchars($adres) . "</p>";
        $orderHtml .= "<table border='1' cellpadding='6' cellspacing='0' style='border-collapse:collapse;'>";
        $orderHtml .= "<tr><th>Product</th><th>Aantal</th><th>Prijs</th><th>Totaal</th></tr>";
        $totaal = 0;
        foreach ($cart as $item) {
            $prijs = floatval(str_replace([',', '€'], ['.', ''], $item['prijs']));
            $subtotaal = $prijs * $item['qty'];
            $totaal += $subtotaal;
            $orderHtml .= "<tr>";
            $orderHtml .= "<td>" . htmlspecialchars($item['naam']) . "</td>";
            $orderHtml .= "<td>" . (int)$item['qty'] . "</td>";
            $orderHtml .= "<td>€" . number_format($prijs, 2, ',', '.') . "</td>";
            $orderHtml .= "<td>€" . number_format($subtotaal, 2, ',', '.') . "</td>";
            $orderHtml .= "</tr>";
        }
        $orderHtml .= "<tr><th colspan='3' style='text-align:right;'>Totaal</th><th>€" . number_format($totaal, 2, ',', '.') . "</th></tr>";
        $orderHtml .= "</table>";

        // Verstuur mail
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'webreus.email';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'noreply@badeendensoep.nl';
            $mail->Password   = 'Thym3n2oo8!';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Ontvanger & afzender
            $mail->setFrom('jouw@email.nl', 'Knip Knap Kappers');
            $mail->addAddress($email, $naam);

            // Inhoud
            $mail->isHTML(true);
            $mail->Subject = 'Bevestiging van je bestelling bij Knip Knap Kappers';
            $mail->Body    = $orderHtml;

            $mail->send();
            $success = true;
            // Leeg winkelwagen-cookie
            setcookie('cart', '', time() - 3600, '/');
        } catch (Exception $e) {
            $error = "Er is iets misgegaan met het versturen van de bevestiging: {$mail->ErrorInfo}";
        }
    }
}

// Zoek adres in database
function zoekAdres($postcode, $huisnummer, $pdo) {
    $postcode = strtoupper(str_replace(' ', '', $postcode));
    $stmt = $pdo->prepare("SELECT straat, plaats FROM adressen WHERE postcode = ? AND huisnummer = ?");
    $stmt->execute([$postcode, $huisnummer]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Gebruik:
$adres = zoekAdres($_POST['postcode'], $_POST['huisnummer'], $pdo);
if ($adres) {
    // Vul straat en woonplaats automatisch in
    $straat = $adres['straat'];
    $woonplaats = $adres['plaats'];
} else {
    // Adres niet gevonden
    $straat = '';
    $woonplaats = '';
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Afrekenen - Knip Knap Kappers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&callback=initAutocomplete" async defer></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Afrekenen</h1>
    <?php if ($success): ?>
        <div class="alert alert-success">
            Je bestelling is geplaatst en een bevestiging is verstuurd naar je e-mailadres.
        </div>
        <a href="index.php" class="btn btn-primary">Terug naar de homepage</a>
    <?php else: ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" class="mb-4" id="checkout-form">
            <div class="mb-3">
                <label for="naam" class="form-label">Naam</label>
                <input type="text" class="form-control" id="naam" name="naam" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mailadres</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="postcode" class="form-label">Postcode</label>
                    <input type="text" class="form-control" id="postcode" name="postcode" maxlength="7" required>
                </div>
                <div class="col-md-4">
                    <label for="huisnummer" class="form-label">Huisnummer</label>
                    <input type="text" class="form-control" id="huisnummer" name="huisnummer" required>
                </div>
                <div class="col-md-4">
                    <label for="toevoeging" class="form-label">Toevoeging</label>
                    <input type="text" class="form-control" id="toevoeging" name="toevoeging">
                </div>
            </div>
            <div class="mb-3">
                <label for="straat" class="form-label">Straat</label>
                <input type="text" class="form-control" id="straat" name="straat" value="<?= htmlspecialchars($straat) ?>" readonly required>
            </div>
            <div class="mb-3">
                <label for="woonplaats" class="form-label">Woonplaats</label>
                <input type="text" class="form-control" id="woonplaats" name="woonplaats" value="<?= htmlspecialchars($woonplaats) ?>" readonly required>
            </div>
            <button type="submit" class="btn btn-success btn-lg">Bestelling plaatsen</button>
        </form>
        <?php if (!empty($cart)): ?>
            <h3>Jouw bestelling</h3>
            <ul class="list-group mb-4">
                <?php $totaal = 0; ?>
                <?php foreach ($cart as $item): ?>
                    <?php
                        $prijs = floatval(str_replace([',', '€'], ['.', ''], $item['prijs']));
                        $subtotaal = $prijs * $item['qty'];
                        $totaal += $subtotaal;
                    ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($item['naam']) ?> (x<?= (int)$item['qty'] ?>)
                        <span>€<?= number_format($subtotaal, 2, ',', '.') ?></span>
                    </li>
                <?php endforeach; ?>
                <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                    Totaal
                    <span>€<?= number_format($totaal, 2, ',', '.') ?></span>
                </li>
            </ul>
        <?php endif; ?>
    <?php endif; ?>
</div>
<script>
let autocomplete;
function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('autocomplete'),
        { types: ['address'], componentRestrictions: { country: 'nl' } }
    );
    autocomplete.setFields(['address_component']);
    autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
    const place = autocomplete.getPlace();
    let straat = '', huisnummer = '', toevoeging = '', postcode = '', woonplaats = '';
    place.address_components.forEach(function(component) {
        const types = component.types;
        if (types.includes('route')) straat = component.long_name;
        if (types.includes('street_number')) huisnummer = component.long_name;
        if (types.includes('subpremise')) toevoeging = component.long_name;
        if (types.includes('postal_code')) postcode = component.long_name;
        if (types.includes('locality')) woonplaats = component.long_name;
    });
    document.getElementById('straat').value = straat;
    document.getElementById('huisnummer').value = huisnummer;
    document.getElementById('toevoeging').value = toevoeging;
    document.getElementById('postcode').value = postcode;
    document.getElementById('woonplaats').value = woonplaats;
}

// Google Places init
window.initAutocomplete = initAutocomplete;
</script>
<script>
function fetchAdres() {
    const postcode = document.getElementById('postcode').value.replace(/\s+/g, '').toUpperCase();
    const huisnummer = document.getElementById('huisnummer').value;
    if (postcode.length === 6 && huisnummer) {
        fetch('https://api.openadres.nl/lookup?postcode=' + postcode + '&huisnummer=' + huisnummer)
        .then(res => res.json())
        .then(data => {
            if (data && data.straat && data.plaats) {
                document.getElementById('straat').value = data.straat;
                document.getElementById('woonplaats').value = data.plaats;
            } else {
                document.getElementById('straat').value = '';
                document.getElementById('woonplaats').value = '';
                alert('Adres niet gevonden. Controleer postcode en huisnummer.');
            }
        })
        .catch(() => {
            document.getElementById('straat').value = '';
            document.getElementById('woonplaats').value = '';
            alert('Adres niet gevonden. Controleer postcode en huisnummer.');
        });
    }
}
document.getElementById('postcode').addEventListener('blur', fetchAdres);
document.getElementById('huisnummer').addEventListener('blur', fetchAdres);
</script>
</body>
</html>