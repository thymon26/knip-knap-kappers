<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welkom bij KnipKnap</title>

  <style>
    /* Prevent all horizontal scroll */
    html, body {
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      font-family: sans-serif;
    }

    .parallax-container {
      position: relative;
      width: 100vw;
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
    }

    .parallax-background {
      background-image: url('assets/product/ideetje.avif');
      z-index: 1;
    }

    .parallax-foreground {
      background-image: url('assets/product/ideetje.jpg');
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
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

    .content {
      position: relative;
      z-index: 4;
      background: white;
      padding: 4rem 2rem;
      color: #333;
    }
  </style>
</head>
<body>

  <section class="parallax-container">
    <div class="parallax-background" id="bg"></div>
    <div class="parallax-foreground" id="fg"></div>
    <div class="parallax-text">Welkom bij KnipKnap</div>
  </section>

  <section class="content">
    <h2>Kom gezellig bij ons knippen!</h2>
    <p>Scroll naar beneden voor meer informatie.</p>
    <div style="height: 1500px;"></div>
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
