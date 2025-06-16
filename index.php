<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welkom bij KnipKnap</title>

  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      overflow-x: hidden;
    }

    .parallax-container {
      position: relative;
      height: 100vh;
      overflow: hidden;
    }

    .parallax-background {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 120%;
      background: url('assets/product/ideetje.avif') no-repeat center center;
      background-size: cover;
      transform: translateY(0);
      z-index: 1;
    }

    .parallax-foreground {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('assets/product/ideetje.jpg') no-repeat center center;
      background-size: contain;
      z-index: 2;
      pointer-events: none;
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
      padding: 4rem 2rem;
      background: #fff;
      color: #333;
      z-index: 4;
    }
  </style>
</head>
<body>

  <main>
    <section class="parallax-container">
      <div class="parallax-background" id="bg"></div>
      <div class="parallax-foreground" id="fg"></div>
      <div class="parallax-text">Welkom bij KnipKnap</div>
    </section>

    <section class="content">
      <p>Kom gezellig bij ons knippen!</p>
      <div style="height: 1000px;"></div>
    </section>
  </main>

  <script>
    // Parallax scroll effect using JavaScript
    window.addEventListener('scroll', function () {
      const scrollY = window.scrollY;
      document.getElementById('bg').style.transform = `translateY(${scrollY * 0.3}px)`;
      document.getElementById('fg').style.transform = `translateY(${scrollY * 0.15}px)`;
    });
  </script>
</body>
</html>
