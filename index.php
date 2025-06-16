<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KnipKnap Parallax</title>

  <style>
    html, body {
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      font-family: sans-serif;
      background: #fff;
    }

    .parallax-section {
      position: relative;
      width: 100%;
      height: 100vh;
      overflow: hidden;
    }

    .parallax-background, .parallax-foreground {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      will-change: transform;
      pointer-events: none;
    }

    .parallax-background {
      background-image: url('assets/product/ideetje.avif');
      z-index: 1;
    }

    .parallax-foreground {
      background-image: url('assets/product/ideetje.jpg');
      background-size: contain;
      z-index: 2;
    }

    .parallax-text {
      position: relative;
      z-index: 3;
      text-align: center;
      padding-top: 40vh;
      color: white;
      font-size: 3rem;
      font-weight: bold;
      text-shadow: 2px 2px 6px #000;
    }

    .main-content {
      position: relative;
      z-index: 10;
      background: #fff;
      padding: 4rem 2rem;
    }
  </style>
</head>
<body>

  <!-- Parallax Section -->
  <section class="parallax-section">
    <div class="parallax-background" id="bg"></div>
    <div class="parallax-foreground" id="fg"></div>
    <div class="parallax-text">Welkom bij KnipKnap</div>
  </section>

  <!-- Main Content Section -->
  <section class="main-content">
    <h2>Over ons</h2>
    <p>Kom gezellig bij ons knippen!</p>

    <h2>Onze Services</h2>
    <ul>
      <li>Knippen dames: €22</li>
      <li>Knippen heren: €22</li>
      <li>Kinderen: €15</li>
    </ul>

    <h2>Contact</h2>
    <p>Adres: KnipKnapstraat 1, Kappersdorp</p>
    <p>Bel: 012-3456789</p>

    <div style="height: 1000px;"></div> <!-- scroll filler -->
  </section>

  <script>
    // Simple scroll parallax effect
    window.addEventListener('scroll', () => {
      const scrollY = window.scrollY;
      document.getElementById('bg').style.transform = `translateY(${scrollY * 0.3}px)`;
      document.getElementById('fg').style.transform = `translateY(${scrollY * 0.15}px)`;
    });
  </script>

</body>
</html>
