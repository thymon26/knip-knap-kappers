<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

$mailSuccess = false;
$mailError = '';
$recaptchaError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = trim($_POST['naam'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $bericht = trim($_POST['bericht'] ?? '');

    // --- reCAPTCHA controle ---
    $recaptchaSecret = '6Lfee0grAAAAAL27Iq5DxwBFI0I2BYUpZYGXkFqv'; // jouw geheime sleutel
    $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';

    if (empty($recaptchaResponse)) {
        $recaptchaError = 'Bevestig dat je geen robot bent.';
    } else {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => $recaptchaSecret,
            'response' => $recaptchaResponse,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ];

        // Gebruik cURL voor de POST
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        if (!isset($result['success']) || $result['success'] !== true) {
            $recaptchaError = 'Bevestig dat je geen robot bent.';
        }
    }
    // --- EINDE reCAPTCHA controle ---

    if ($naam && $email && $bericht && filter_var($email, FILTER_VALIDATE_EMAIL) && !$recaptchaError) {
        try {
            // 1. Mail naar info@badeendensoep.nl
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = 'webreus.email';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'noreply@badeendensoep.nl';
            $mail->Password   = 'Thym3n2oo8!';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('noreply@badeendensoep.nl', 'Knip Knap Kappers');
            $mail->addAddress('info@badeendensoep.nl', 'Knip Knap Kappers');
            $mail->addReplyTo($email, $naam);

            $mail->isHTML(true);
            $mail->Subject = 'Nieuw contactformulier via de website';
            $mail->Body = '
                <div style="background:#fcfaf6;padding:32px 0;">
                  <div style="max-width:520px;margin:0 auto;background:#fffbe9;border-radius:18px;box-shadow:0 4px 24px rgba(191,160,70,0.10);padding:32px 28px 24px 28px;font-family:sans-serif;">
                    <div style="text-align:center;margin-bottom:18px;">
                      <img src="https://barber.badeendensoep.nl/assets/logo.png" alt="Contact" style="width:44px;height:44px;opacity:0.8;">
                      <h2 style="color:#bfa046;font-size:1.3rem;margin:12px 0 0 0;font-weight:800;">Nieuw contactformulier</h2>
                    </div>
                    <p style="font-size:1.08rem;color:#222;margin-bottom:18px;">
                      <b>Naam:</b> ' . htmlspecialchars($naam) . '<br>
                      <b>E-mail:</b> ' . htmlspecialchars($email) . '
                    </p>
                    <div style="background:#fffde7;border-radius:10px;padding:12px 16px;margin-bottom:18px;">
                      <span style="color:#bfa046;font-weight:600;">Bericht:</span><br>
                      <span style="color:#444;">' . nl2br(htmlspecialchars($bericht)) . '</span>
                    </div>
                    <div style="text-align:center;color:#bbb;font-size:0.97rem;margin-top:18px;">
                      &copy; ' . date('Y') . ' Knip Knap Kappers
                    </div>
                  </div>
                </div>
            ';
            $mail->AltBody = "Naam: $naam\nE-mail: $email\nBericht:\n$bericht";
            $mail->send();

            // 2. Bevestiging naar de verzender
            $bevestig = new PHPMailer(true);
            $bevestig->isSMTP();
            $bevestig->Host       = 'webreus.email';
            $bevestig->SMTPAuth   = true;
            $bevestig->Username   = 'noreply@badeendensoep.nl';
            $bevestig->Password   = 'Thym3n2oo8!';
            $bevestig->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $bevestig->Port       = 587;

            $bevestig->setFrom('noreply@badeendensoep.nl', 'Knip Knap Kappers');
            $bevestig->addAddress($email, $naam);
            $bevestig->addReplyTo('info@badeendensoep.nl', 'Knip Knap Kappers');

            $bevestig->isHTML(true);
            $bevestig->Subject = 'Bedankt voor je bericht aan Knip Knap Kappers';
            $bevestig->Body = '
                <div style="background:#fcfaf6;padding:32px 0;">
                  <div style="max-width:520px;margin:0 auto;background:#fffbe9;border-radius:18px;box-shadow:0 4px 24px rgba(191,160,70,0.10);padding:32px 28px 24px 28px;font-family:sans-serif;">
                    <div style="text-align:center;margin-bottom:18px;">
                      <img src="https://barber.badeendensoep.nl/assets/logo.png" alt="Contact" style="width:44px;height:44px;opacity:0.8;">
                      <h2 style="color:#bfa046;font-size:1.3rem;margin:12px 0 0 0;font-weight:800;">Bedankt voor je bericht!</h2>
                    </div>
                    <p style="font-size:1.08rem;color:#222;margin-bottom:18px;">
                      Beste ' . htmlspecialchars($naam) . ',<br>
                      Bedankt voor je bericht aan Knip Knap Kappers.<br>
                      We nemen zo snel mogelijk contact met je op.<br><br>
                      <b>Je bericht:</b>
                    </p>
                    <div style="background:#fffde7;border-radius:10px;padding:12px 16px;margin-bottom:18px;">
                      <span style="color:#444;">' . nl2br(htmlspecialchars($bericht)) . '</span>
                    </div>
                    <div style="text-align:center;color:#bbb;font-size:0.97rem;margin-top:18px;">
                      &copy; ' . date('Y') . ' Knip Knap Kappers
                    </div>
                  </div>
                </div>
            ';
            $bevestig->AltBody = "Beste $naam,\n\nBedankt voor je bericht aan Knip Knap Kappers. We nemen zo snel mogelijk contact met je op.\n\nJe bericht:\n$bericht";
            $bevestig->send();

            $mailSuccess = true;
        } catch (Exception $e) {
            $mailError = "Er ging iets mis met het versturen van je bericht. Probeer het later opnieuw.";
        }
    } elseif ($recaptchaError) {
        $mailError = $recaptchaError;
    } else {
        $mailError = "Vul alle velden correct in.";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Contact | Kapperszaak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kapperszaak Aventus Apeldoorn - Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f6f6f6;
        }
        .map-container {
            margin-top: 32px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0,0,0,0.10);
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>
        <br><br><br><br><br><br><br><br>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4">Contact opnemen met Kapperszaak Aventus Apeldoorn</h1>
                <p>Heb je vragen of wil je een afspraak maken? Vul het formulier in en wij nemen zo snel mogelijk contact met je op!</p>
                <?php if (!empty($mailSuccess)): ?>
                    <div class="alert alert-success">Bedankt voor je bericht! We nemen zo snel mogelijk contact met je op.</div>
                <?php elseif (!empty($mailError)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($mailError) ?></div>
                <?php endif; ?>
                <form id="contactForm" class="mb-4 p-4 bg-white rounded shadow-sm" method="POST" action="">
                    <div class="mb-3">
                        <label for="naam" class="form-label">Naam</label>
                        <input type="text" class="form-control" id="naam" name="naam" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mailadres</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="bericht" class="form-label">Bericht</label>
                        <textarea class="form-control" id="bericht" name="bericht" rows="5" required></textarea>
                    </div>
                    <div class="g-recaptcha mb-3" data-sitekey="6Lfee0grAAAAAPLc4dQycwoKSm_dtmjfCDdcMcjf"></div>
                    <button type="submit" class="btn btn-primary">Verzenden</button>
                </form>
                <h2 class="mt-5">Waar vind je ons?</h2>
                <p>Onze kapperszaak is gevestigd in Aventus, Apeldoorn:</p>
                <address>
                    Laan van de Mensenrechten 500,<br>
                    7331 VZ Apeldoorn
                </address>
                <div class="map-container mb-4">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2436.282236529129!2d5.963726316026385!3d52.21094297975706!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c7a9b7e6e2c7e7%3A0x6e4b2c7b3e7c7e7e!2sAventus%2C%20Laan%20van%20de%20Mensenrechten%20500%2C%207331%20VZ%20Apeldoorn!5e0!3m2!1snl!2snl!4v1717670000000!5m2!1snl!2snl"
                        width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>