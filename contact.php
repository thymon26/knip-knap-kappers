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
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4">Contact opnemen met Kapperszaak Aventus Apeldoorn</h1>
                <p>Heb je vragen of wil je een afspraak maken? Vul het formulier in en wij nemen zo snel mogelijk contact met je op!</p>
                <form id="contactForm" class="mb-4 p-4 bg-white rounded shadow-sm">
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
                    <button type="submit" class="btn btn-primary">Verzenden</button>
                </form>
                <div id="formMessage"></div>
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
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('formMessage').innerHTML = "<div class='alert alert-success'>Bedankt voor je bericht! We nemen zo snel mogelijk contact met je op.</div>";
            this.reset();
        });
    </script>
</body>
</html>