<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Contact | Kapperszaak</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f7f7f7; }
        .container { max-width: 800px; margin: auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px #ccc; }
        h1, h2 { color: #333; }
        form { display: flex; flex-direction: column; gap: 10px; }
        label { font-weight: bold; }
        input, textarea { padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #2d89ef; color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; }
        button:hover { background: #1b5fa7; }
        .info, .events, .hours { margin-bottom: 25px; }
        iframe { border: 0; width: 100%; height: 250px; border-radius: 8px; }
        .success { color: green; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contact</h1>

        <div class="info">
            <h2>Adres & Contactgegevens</h2>
            <p>
                Kapperszaak KinpKnap<br>
                Hoofdstraat 123<br>
                1234 AB Stad<br>
                Telefoon: <a href="tel:0612345678">06-12345678</a><br>
                E-mail: <a href="mailto:info@KinpKnap.nl">info@KnipKnap.nl</a>
            </p>
            <h3>Locatie op de kaart</h3>
            <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4889.902350219468!2d5.968991676912405!3d52.20793475928673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c7b882276703df%3A0x2c7987fa5413b368!2sAventus%2C%20Laan%20van%20de%20Mensenrechten%20Apeldoorn!5e0!3m2!1snl!2snl!4v1749196011160!5m2!1snl!2snl" 
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Locatie van KnipKnap"></iframe>
            </iframe>
        </div>

        <div class="hours">
            <h2>Openingstijden</h2>
            <ul>
                <li>Maandag: 09:00 - 18:00</li>
                <li>Dinsdag: 09:00 - 18:00</li>
                <li>Woensdag: 09:00 - 18:00</li>
                <li>Donderdag: 09:00 - 20:00</li>
                <li>Vrijdag: 09:00 - 18:00</li>
                <li>Zaterdag: 09:00 - 16:00</li>
                <li>Zondag: Gesloten</li>
            </ul>
        </div>

        <div class="events">
            <h2>Speciale Evenementen</h2>
            <ul>
                <li>Vrijdag 14 juni: Thema-avond "Summer Hair Trends" (18:00 - 21:00)</li>
                <li>Zaterdag 29 juni: Kinderknipdag met gratis limonade</li>
            </ul>
        </div>

        <div class="form-section">
            <h2>Contactformulier</h2>
            <form id="contactForm">
                <label for="naam">Naam:</label>
                <input type="text" id="naam" name="naam" required>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>

                <label for="telefoon">Telefoonnummer:</label>
                <input type="tel" id="telefoon" name="telefoon">

                <label for="bericht">Bericht / Afspraak:</label>
                <textarea id="bericht" name="bericht" rows="4" required></textarea>

                <button type="submit">Verzenden</button>
                <div id="formMessage" class="success"></div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('formMessage').textContent = "Bedankt voor uw bericht! We nemen zo snel mogelijk contact met u op.";
            this.reset();
        });
    </script>
</body>
</html>