<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sticky Transparante Header</title>

    <style>
        * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
.header.shrink .reserveren:hover {
  font-size: 1rem;
  box-shadow: 0 12px 25px rgba(255, 215, 0, 0.6);
  transform: translateY(-3px);
}
body {
  font-family: sans-serif;
  background: #f5f5f5;
  padding-top: 0; /* ruimte boven content zodat header niet overlapt */
}

.header {
  position: fixed;
  top: 20px;
  left: 50%;
  transform: translateX(-50%);
  width: 90%;
  max-width: 1200px;
  border-radius: 16px;
  backdrop-filter: blur(12px);
  background-color: rgba(255, 255, 255, 0.6);
  transition: all 0.4s ease;
  z-index: 1000;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
  opacity: 0;
  animation: fadeInDown 0.8s ease forwards;
  animation-delay: 0.2s;
}

.logo {
  width: 70px;
  height: 70px;
}
.nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 1rem;
  transition: all 0.4s ease;
}

.nav.shrink {
  padding: 0.5rem 1rem;
}

.nav.shrink .logo {
  width: 50px;
  height: 50px;
}

.nav.shrink .nav-links {
  gap: 1rem;
  font-size: 1.4rem;
}

.nav.shrink .nav-links a {
  font-size: 0.95rem;
}

.header.shrink {
  top: 10px;
  width: 40%;
  border-radius: 12px;
  background-color: rgba(255, 255, 255, 0.85);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
  padding: 0;
}


@keyframes fadeInDown {
  to {
    opacity: 1;
    transform: translate(-50%, 0);
  }
}
.nav-links {
  list-style: none;
  display: flex;
  align-items: center;
  gap: 2rem;
  margin-left: auto;
}

.nav-links li:last-child {
  margin-left: auto;
  display: flex;
  align-items: center;
}

.reserveren {
  margin-left: 0;
  float: none;
}
.nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 2rem 3rem;
  transition: all 0.4s ease;
}

.nav-links a {
  text-decoration: none;
  color: #000;
  font-weight: 500;
  position: relative;
  transition: color 0.3s ease;
}

.nav-links a::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: -4px;
  width: 100%;
  height: 2px;
  background: #000;
  transform: scaleX(0);
  transform-origin: right;
  transition: transform 0.3s ease;
}

.nav-links a:hover::after {
  transform: scaleX(1);
  transform-origin: left;
}

.reserveren {
    background: linear-gradient(145deg, #0b0b0a, #63635f);
    color: #f8f4f4;
    border: none;
    padding: 10px 20px;
    font-size: 1rem;
    border-radius: 50px;
    box-shadow: 0 8px 20px rgba(2, 2, 2, 0.5);
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
    float: right;
    margin-left: 20px;
  }

  .reserveren::before {
    content: '';
    position: absolute;
    top: 0;
    left: -75%;
    width: 50%;
    height: 100%;
    background: rgba(255, 255, 255, 0.2);
    transform: skewX(-25deg);
    transition: left 0.4s ease;
  }

  .reserveren:hover::before {
    left: 100%;
  }

  .reserveren:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(255, 215, 0, 0.6);
    font-size: 100%;
  }

.hero {
  height: 100vh;
  background: linear-gradient(to bottom, #ffffff, #e0e0e0);
  display: flex;
  justify-content: center;
  align-items: center;
  padding-top: 0;
  margin-top: 0;
}

.content {
  padding: 4rem;
}
    </style>

    <script>
document.addEventListener('DOMContentLoaded', () => {
  let lastScrollTop = 0;
  const nav = document.querySelector('.nav');
  const header = document.querySelector('.header');

  window.addEventListener('scroll', () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop + 10) {
      // Scroll naar beneden
      nav.classList.add('shrink');
      header.classList.add('shrink');
    } else if (scrollTop < lastScrollTop - 10 || scrollTop <= 0) {
      // Scroll naar boven
      nav.classList.remove('shrink');
      header.classList.remove('shrink');
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
  });
});
</script>
<!-- Services Boxes CSS -->
<style>
.services-container {
  display: flex;
  flex-wrap: wrap;
  gap: 2rem;
  justify-content: center;
  margin: 2rem 0;
}
.service-box {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 4px 16px rgba(0,0,0,0.08);
  padding: 2rem 1.5rem;
  width: 260px;
  min-height: 210px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  transition: transform 0.2s, box-shadow 0.2s;
}
.service-box:hover {
  transform: translateY(-6px) scale(1.03);
  box-shadow: 0 8px 32px rgba(0,0,0,0.14);
}
.service-title {
  font-size: 1.2rem;
  font-weight: bold;
  margin-bottom: 0.5rem;
  color: #222;
}
.service-desc {
  font-size: 1rem;
  color: #555;
  margin-bottom: 1.2rem;
}
.service-price {
  margin-top: auto;
  font-size: 1.1rem;
  font-weight: 600;
  color: #bfa046;
  letter-spacing: 0.5px;
}
@media (max-width: 900px) {
  .services-container {
    flex-direction: column;
    align-items: center;
  }
  .service-box {
    width: 90%;
    max-width: 350px;
  }
}
</style>
</head>
<body>
  <header class="header">
    <nav class="nav">
      <img src="/Assets/logo.png" alt="Logo" class="logo"/>
      <ul class="nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="#">Producten</a></li>
        <li><a href="#">Prijzen</a></li>
        <li><a href="#">Contact</a></li>
        <li><button class="reserveren" onclick="location.href='/Pages/Reserveren.html'">Reserveren</button></li>
      </ul>
    </nav>
  </header>
  <main>
    <section class="hero">
      <h1>Welkom Bij KnipKnap</h1>
    </section>
    <section class="content">
      <p>Kom gezellig bij ons knippen!</p>
      <div style="height: 1000px;"></div>
    </section>
    <section class="content" id="services">
      <p>Onze services</p>
      <div style="margin-bottom: 1.5rem;">
        <button class="service-filter-btn" data-filter="dames">Dames</button>
        <button class="service-filter-btn" data-filter="heren">Heren</button>
        <button class="service-filter-btn" data-filter="kinderen">Kinderen</button>
      </div>
      <div class="services-container">
        <div class="service-box" data-type="dames">
          <div class="service-title">Knippen Dames</div>
          <div class="service-desc">Professioneel knippen voor dames. 
            <p>Keuze uit meerdere behandelingen. </p>
            <p>Bekijk al onze knip services met prijzen.</p>
          </div>
          <div class="service-price">€22</div>
        </div>
        <div class="service-box" data-type="heren">
          <div class="service-title">Knippen Heren</div>
          <div class="service-desc">Professioneel knippen voor heren.</div>
          <div class="service-price">€22</div>
        </div>
        <div class="service-box" data-type="kinderen">
          <div class="service-title">Baby/Kinderen</div>
          <div class="service-desc">Knippen voor baby's en kinderen t/m 12 jaar.</div>
          <div class="service-price">€15</div>
        </div>
        <div class="service-box" data-type="dames">
          <div class="service-title">Verven</div>
          <div class="service-desc">Volledige haarkleuring met kwaliteitsproducten.</div>
          <div class="service-price">v.a. €38</div>
        </div>
        <div class="service-box" data-type="dames">
          <div class="service-title">Kleurspoeling</div>
          <div class="service-desc">Tijdelijke kleurspoeling voor een frisse look.</div>
          <div class="service-price">v.a. €28</div>
        </div>
        <div class="service-box" data-type="dames">
          <div class="service-title">Highlights</div>
          <div class="service-desc">Highlights voor een natuurlijk lichte uitstraling.</div>
          <div class="service-price">v.a. €45</div>
        </div>
        <div class="service-box" data-type="dames">
          <div class="service-title">Balayage</div>
          <div class="service-desc">Trendy balayage techniek voor een subtiele overgang.</div>
          <div class="service-price">v.a. €65</div>
        </div>
        <div class="service-box" data-type="dames">
          <div class="service-title">Blonderen</div>
          <div class="service-desc">Blonderen voor een stralend blond resultaat.</div>
          <div class="service-price">v.a. €50</div>
        </div>
        <div class="service-box" data-type="dames heren kinderen">
          <div class="service-title">Styling</div>
          <div class="service-desc">Styling voor elke gelegenheid, van casual tot feestelijk.</div>
          <div class="service-price">v.a. €18</div>
        </div>
        <div class="service-box" data-type="dames heren kinderen">
          <div class="service-title">Verzorging</div>
          <div class="service-desc">Intensieve haarverzorging en treatments.</div>
          <div class="service-price">v.a. €12</div>
        </div>
        <div class="service-box" data-type="dames">
          <div class="service-title">Permanent</div>
          <div class="service-desc">Permanente omvorming voor meer volume of krul.</div>
          <div class="service-price">v.a. €55</div>
        </div>
      </div>
      <div style="height: 1000px;"></div>
    </section>
    <section class="content">
      <p>Gallerij</p>
      <div style="height: 1000px;"></div>
    </section>
    <section class="content">
      <p>Producten</p>
      <div style="height: 1000px;"></div>
    </section>
    <section class="content">
      <p>Openingstijden</p>
      <div style="height: 1000px;"></div>
    </section>
  </main>

  <script>
    // Service filter functionaliteit
    document.addEventListener('DOMContentLoaded', function () {
      const filterButtons = document.querySelectorAll('.service-filter-btn');
      const serviceBoxes = document.querySelectorAll('.service-box');

      function filterServices(type) {
        serviceBoxes.forEach(box => {
          const types = box.getAttribute('data-type').split(' ');
          if (types.includes(type)) {
            box.style.display = '';
          } else {
            box.style.display = 'none';
          }
        });
      }

      filterButtons.forEach(btn => {
        btn.addEventListener('click', function () {
          filterButtons.forEach(b => b.classList.remove('active'));
          this.classList.add('active');
          filterServices(this.getAttribute('data-filter'));
        });
      });

      // Standaard: alleen dames tonen
      filterServices('dames');
      filterButtons[0].classList.add('active');
    });
  </script>
  
  <style>
    .service-filter-btn {
      background: #bfa046;
      color: #fff;
      border: none;
      border-radius: 30px;
      padding: 0.5rem 1.5rem;
      margin-right: 0.5rem;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
      font-weight: 600;
    }
    .service-filter-btn.active,
    .service-filter-btn:hover {
      background: #222;
      color: #ffd700;
    }
  </style>
