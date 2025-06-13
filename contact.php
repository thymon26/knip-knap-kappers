<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kapperszaak Aventus Apeldoorn - Contact</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6f6f6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 32px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        h1 {
            color: #2d2d2d;
        }
        form {
            margin-bottom: 32px;
        }
        label {
            display: block;
            margin-top: 16px;
            margin-bottom: 6px;
            color: #444;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #bbb;
            border-radius: 4px;
            font-size: 1em;
        }
        button {
            margin-top: 18px;
            padding: 10px 24px;
            background: #0078d7;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
        }
        button:hover {
            background: #005fa3;
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
    <?php
    // Include the header file
    include 'header.php';
    ?>
        <br><br><br><br><br><br><br><br>
    <div class="container">
        <h1>Contact opnemen met Kapperszaak Aventus Apeldoorn</h1>
        <p>Heb je vragen of wil je een afspraak maken? Vul het formulier in en wij nemen zo snel mogelijk contact met je op!</p>
        <form id="contactForm">
            <label for="naam">Naam</label>
            <input type="text" id="naam" name="naam" required>

            <label for="email">E-mailadres</label>
            <input type="email" id="email" name="email" required>

            <label for="bericht">Bericht</label>
            <textarea id="bericht" name="bericht" rows="5" required></textarea>

            <button type="submit">Verzenden</button>
        </form>
        <div id="formMessage"></div>

        <h2>Waar vind je ons?</h2>
        <p>Onze kapperszaak is gevestigd in Aventus, Apeldoorn:</p>
        <address>
            Laan van de Mensenrechten 500,<br>
            7331 VZ Apeldoorn
        </address>
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2436.282236529129!2d5.963726316026385!3d52.21094297975706!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c7a9b7e6e2c7e7%3A0x6e4b2c7b3e7c7e7e!2sAventus%2C%20Laan%20van%20de%20Mensenrechten%20500%2C%207331%20VZ%20Apeldoorn!5e0!3m2!1snl!2snl!4v1717670000000!5m2!1snl!2snl"
                width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <script>
        // Simpele form handler (stuurt niet echt een mail)
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('formMessage').innerHTML = "<p style='color:green;'>Bedankt voor je bericht! We nemen zo snel mogelijk contact met je op.</p>";
            this.reset();
        });
    </script>
</body>
</html>