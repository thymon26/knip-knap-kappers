<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Knip Knap Kappers - Home</title>


<!-- Services Boxes CSS -->
<style>
  .banner{
      background-image: url("assets/product/ideetje2\ -\ Copy.jpg");
      perspective: 100px;
      height: 100vh;
      overflow-x: hidden;
      overflow-y: auto;
      position: absolute;
      top: 0;
      left: 50%;
      right: 0;
      bottom: 0;
      margin-left: -1500px;
    }

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

  /* Hero styling */
  .hero {
  min-height: 60vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  position: relative;
  z-index: 1;
  padding-top: 80px;
  padding-bottom: 60px;
  background: url('assets/background.png') center center/cover no-repeat;
}
.hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(255, 255, 255, 0.57); /* overlay voor leesbaarheid */
  z-index: -1;
}
  .hero h1 {
    font-size: 2.8rem;
    font-weight: 800;
    color: #bfa046;
    margin-bottom: 1.2rem;
    letter-spacing: 1px;
    text-shadow: 0 2px 8px rgba(0,0,0,0.06);
  }
  .hero .lead {
    font-size: 1.25rem;
    color: #222;
    max-width: 600px;
    margin: 0 auto 0.5rem auto;
    font-weight: 500;
    line-height: 1.6;
  }
  @media (max-width: 600px) {
    .hero h1 {
      font-size: 2rem;
    }
    .hero .lead {
      font-size: 1.05rem;
    }
  }
</style>
</head>
<body>
<?php
// Include header file 
include 'header.php';
?>
  <main>
    <section class="hero">
      <h1>Welkom bij Knip Knap Kappers</h1>
      <p class="lead">
        Knip Knap Kappers is niet zomaar een kapsalon: bij ons kun je niet alleen terecht voor een frisse coupe, maar ook voor een gezellig drankje aan onze bar.<br>
        Kom langs voor een knipbeurt én geniet van een ontspannen sfeer met een kop koffie, thee of iets anders lekkers!
      </p>
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
