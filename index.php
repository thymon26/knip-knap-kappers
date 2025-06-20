<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Knip Knap Kappers - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


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

    #services .service-box {
  border: 2px solid #f3e7c1;
  box-shadow: 0 2px 12px rgba(191,160,70,0.07);
  transition: box-shadow 0.2s, transform 0.2s;
}
#services .service-box:hover {
  box-shadow: 0 8px 32px rgba(191,160,70,0.18);
  border-color: #bfa046;
  transform: translateY(-8px) scale(1.04);
}
#services .service-title {
  font-size: 1.18rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
  color: #bfa046;
  letter-spacing: 0.5px;
}
#services .service-price {
  font-size: 1.15rem;
  font-weight: 700;
  color: #222;
  margin-top: 1.2rem;
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
    .hero-content {
    background: #fff;
    border-radius: 24px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.10);
    padding: 2.5rem 2rem 2rem 2rem;
    max-width: 650px;
    margin: 0 auto;
    display: inline-block;
    position: relative;
    z-index: 2;
    opacity: 0.97;
    }
    @media (max-width: 700px) {
      .hero-content {
        padding: 1.2rem 0.8rem 1.2rem 0.8rem;
        max-width: 98vw;
      }
    }

  .openingstijden-container {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 4px 24px rgba(191,160,70,0.10);
    max-width: 420px;
    margin: 2.5rem auto 2rem auto;
    padding: 2.2rem 2rem 1.5rem 2rem;
    text-align: center;
    position: relative;
  }
  .openingstijden-title {
    color: #bfa046;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1.2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.6rem;
  }
  .openingstijden-tabel {
    width: 100%;
    margin: 0 auto 1.2rem auto;
    border-collapse: separate;
    border-spacing: 0 0.3rem;
    font-size: 1.08rem;
  }
  .openingstijden-tabel td {
    padding: 0.4rem 0.7rem;
    border-radius: 8px;
    background: #f8f6f2;
    color: #222;
  }
  .openingstijden-tabel tr td:first-child {
    font-weight: 600;
    text-align: left;
    background: #fffbe9;
  }
  .openingstijden-tabel .gesloten {
    color: #fff;
    background: #bfa046;
    font-weight: 700;
    text-align: center;
  }
  .openingstijden-tabel .avond {
    background: #bfa046;
    color: #fff;
    border-radius: 8px;
    padding: 0.1rem 0.6rem;
    font-size: 0.95em;
    margin-left: 0.5rem;
    font-weight: 500;
  }
  .openingstijden-bar-tip {
    margin-top: 1.2rem;
    color: #bfa046;
    font-size: 1.08rem;
    background: #fffbe9;
    border-radius: 12px;
    padding: 0.7rem 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
  }
  @media (max-width: 600px) {
    .openingstijden-container {
      padding: 1.2rem 0.5rem 1rem 0.5rem;
      max-width: 99vw;
    }
    .openingstijden-title {
      font-size: 1.3rem;
    }
  }

  /* Product Card Styling - exact als producten.php */
    #top-producten .row {

        align-items: stretch;
    }

    #top-producten .card.h-100 {
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
        transition: transform 0.2s, box-shadow 0.2s;
        overflow: visible; /* belangrijk voor zweven */
    }
    #top-producten .img-hover-wrapper {
        position: relative;
        height: 220px; /* zelfde als max-height afbeelding */
        width: 100%;
        overflow: visible;
        z-index: 1;
    }
    #top-producten .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        transition: 
            transform 0.4s cubic-bezier(.4,2,.6,1), 
            box-shadow 0.3s;
        position: relative;
        z-index: 2;
        background: none;
    }
    #top-producten .card.h-100:hover .img-hover-wrapper .card-img-top {
        /* Alleen vergroten, niet verplaatsen */
        transform: scale(1.08);
        z-index: 20;
        background: none;
    }
    #top-producten .card-body {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    #top-producten .card-footer {
        background: #fff;
        border-top: none;
    }
    #top-producten .card.h-100:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        z-index: 2;
    }
    #top-producten .add-to-cart-btn {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        background: rgba(80,80,80,0.7); /* grijs en doorzichtig */
        color: #fff;
        border: none;
        border-radius: 0 0 0.5rem 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s;
        z-index: 10;
    }
    #top-producten .card.h-100:hover .add-to-cart-btn {
        opacity: 1;
        pointer-events: auto;
    }

    /* Gallerij styling */
    .gallery-img {
  width: 100%;
  height: 220px;
  object-fit: cover;
  aspect-ratio: 1/1;
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(191,160,70,0.08);
  transition: transform 0.25s, box-shadow 0.2s;
}
.gallery-thumb:hover .gallery-img {
  transform: scale(1.06);
  box-shadow: 0 8px 24px rgba(191,160,70,0.18);
}
@media (max-width: 700px) {
  .gallery-img { height: 120px; }
}
  </style>
</head>
<body>
<?php
// Include header file 
include 'header.php';
?>
<br><br> 
<?php
require_once 'db.php';
$services = $pdo->query("SELECT * FROM services WHERE actief = 1 ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);

// Haal de 3 bestverkochte producten op via order_items
$top3 = $pdo->query("
    SELECT 
        p.*, 
        SUM(oi.aantal) as totaal_verkocht
    FROM producten p
    JOIN order_items oi ON oi.product_id = p.id
    GROUP BY p.id
    ORDER BY totaal_verkocht DESC
    LIMIT 3
")->fetchAll(PDO::FETCH_ASSOC);
?>
  <main>
    <section class="hero">
      <div class="hero-content">
        <h1>Welkom bij Knip Knap Kappers</h1>
        <p class="lead">
          Knip Knap Kappers is niet zomaar een kapsalon: bij ons kun je niet alleen terecht voor een frisse coupe, maar ook voor een gezellig drankje aan onze bar.<br>
          Kom langs voor een knipbeurt én geniet van een ontspannen sfeer met een kop koffie, thee of iets anders lekkers!
        </p>
      </div>
    </section>

    <div class="container my-4">
      <div class="alert alert-warning d-flex align-items-center justify-content-center shadow-sm" style="border-radius: 18px; font-size: 1.15rem; background: #fffbe9; color: #bfa046; border: 1.5px solid #ffe08a;">
        <i class="bi bi-award-fill me-2" style="font-size:1.7rem;"></i>
        Spaar nu met onze stempelkaart: bij elke knipbeurt een stempel, en bij een volle kaart krijg je een gratis knipbeurt cadeau!
      </div>
    </div>

    <section class="content" id="services" style="background: #fcfaf6; padding: 3rem 0 2rem 0;">

<section class="content" id="services" style="background: #fcfaf6; padding: 3rem 0 2rem 0;">
  <div class="container">
    <h2 style="text-align:center; color:#bfa046; font-weight:800; margin-bottom:0.5rem;">
      <i class="bi bi-scissors"></i> Onze behandelingen & services
    </h2>
    <p style="text-align:center; color:#555; font-size:1.15rem; margin-bottom:2.2rem;">
      Kies uit onze professionele behandelingen voor dames, heren en kinderen.<br>
      Voor elk haartype en elke wens hebben wij een passende service!
    </p>
    <div class="row g-4 justify-content-center">
      <?php foreach($services as $service): ?>
        <div class="col-md-4 col-lg-3">
          <div class="service-box h-100 text-center">
            <div style="font-size:2.2rem; color:#bfa046;">
              <i class="bi <?= htmlspecialchars($service['icoon']) ?>"></i>
            </div>
            <div class="service-title"><?= htmlspecialchars($service['naam']) ?></div>
            <div class="service-desc"><?= htmlspecialchars($service['beschrijving']) ?></div>
            <div class="service-price">
              <?= strpos($service['prijs'], '.') !== false ? 'v.a. ' : '' ?>€<?= number_format($service['prijs'], 2, ',', '.') ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
    <section class="content" id="gallerij">
  <div class="container py-4">
    <h2 style="text-align:center; color:#bfa046; font-weight:800; margin-bottom:1.5rem;">
      <i class="bi bi-images"></i> Gallerij
    </h2>
    <div class="row g-3 justify-content-center">
      <?php
        $dir = __DIR__ . '/assets/gallerij/';
        $webDir = 'assets/gallerij/';
        $allowed = ['jpg','jpeg','png','gif','webp'];
        $images = [];
        if(is_dir($dir)) {
          foreach(scandir($dir) as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if(in_array($ext, $allowed)) {
              $images[] = $file;
            }
          }
        }
        if(empty($images)): ?>
          <div class="col-12 text-center text-muted">Nog geen foto's in de gallerij.</div>
        <?php else:
          foreach($images as $img): ?>
            <div class="col-6 col-md-4 col-lg-3">
              <a href="<?= $webDir . urlencode($img) ?>" target="_blank" class="gallery-thumb d-block mb-2">
                <img src="<?= $webDir . urlencode($img) ?>" class="img-fluid rounded shadow-sm gallery-img" alt="Gallerij foto">
              </a>
            </div>
          <?php endforeach;
        endif;
      ?>
    </div>
  </div>
</section>
    <section class="content" id="top-producten">
      <h2 style="text-align:center; color:#bfa046; font-weight:700; margin-bottom:1.5rem;">
        <i class="bi bi-star-fill"></i> Top 3 Best Verkochte Producten
      </h2>
      <div class="container">
        <div class="row">
          <?php foreach($top3 as $product): ?>
              <div class="col-md-4 mb-4">
                  <div class="card h-100" data-product-id="<?= $product['id'] ?>">
                      <div class="img-hover-wrapper">
                          <img src="<?= htmlspecialchars($product['afbeelding']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['naam']) ?>">
                      </div>
                      <div class="card-body">
                          <h5 class="card-title"><?= htmlspecialchars($product['naam']) ?></h5>
                          <p class="card-text"><?= htmlspecialchars($product['beschrijving']) ?></p>
                      </div>
                      <div class="card-footer">
                          <?php if (!empty($product['korting'])): ?>
                              <span class="text-decoration-line-through text-muted">€<?= number_format($product['prijs'], 2, ',', '.') ?></span>
                              <strong class="ms-2 text-success">
                                  €<?= number_format($product['prijs'] - $product['korting'], 2, ',', '.') ?>
                              </strong>
                              <span class="badge bg-success ms-2">Korting!</span>
                          <?php else: ?>
                              <strong>€<?= number_format($product['prijs'], 2, ',', '.') ?></strong>
                          <?php endif; ?>
                      </div>
                      <button class="btn  add-to-cart-btn" style="background-color: rgba(80,80,80,0.7); COLOR: #fff; border: none;">
                          <i class="bi bi-cart-plus"></i> Add to cart
                      </button>
                  </div>
              </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <section class="content" id="openingstijden">
      <div class="openingstijden-container">
        <h2 class="openingstijden-title"><i class="bi bi-clock"></i> Openingstijden</h2>
        <table class="openingstijden-tabel">
          <tbody>
            <tr><td>Maandag</td><td>09:00 - 18:00</td></tr>
            <tr><td>Dinsdag</td><td>09:00 - 18:00</td></tr>
            <tr><td>Woensdag</td><td>09:00 - 18:00</td></tr>
            <tr><td>Donderdag</td><td>09:00 - 20:00 <span class="avond">Late night!</span></td></tr>
            <tr><td>Vrijdag</td><td>09:00 - 18:00</td></tr>
            <tr><td>Zaterdag</td><td>09:00 - 16:00</td></tr>
            <tr><td>Zondag</td><td class="gesloten">Gesloten</td></tr>
          </tbody>
        </table>
        <div class="openingstijden-bar-tip">
          <i class="bi bi-cup-straw"></i> Onze bar is tijdens openingstijden geopend voor koffie, thee, fris en een lekkere alcoholische versnapering !
        </div>
      </div>
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
<script>
function setCartCookie(cart) {
    document.cookie = "cart=" + encodeURIComponent(JSON.stringify(cart)) + ";path=/;max-age=31536000";
}
function getCartCookie() {
    const match = document.cookie.match(/(?:^|; )cart=([^;]*)/);
    return match ? JSON.parse(decodeURIComponent(match[1])) : [];
}
function updateCartCount() {
    const cart = getCartCookie();
    let count = 0;
    cart.forEach(item => count += item.qty || 1);
    const el = document.getElementById('cartCount');
    if(el) el.textContent = count;
}
updateCartCount();

document.querySelectorAll('#top-producten .add-to-cart-btn').forEach((btn, idx) => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();

        // Vind de kaart en afbeelding
        const card = btn.closest('.card');
        const img = card.querySelector('.card-img-top');
        const rect = img.getBoundingClientRect();

        // Clone de afbeelding
        const clone = img.cloneNode(true);
        clone.style.position = 'fixed';
        clone.style.left = rect.left + 'px';
        clone.style.top = rect.top + 'px';
        clone.style.width = rect.width + 'px';
        clone.style.height = rect.height + 'px';
        clone.style.zIndex = 9999;
        clone.style.pointerEvents = 'none';
        clone.style.transition = 'all 0.8s cubic-bezier(.4,2,.6,1)';
        document.body.appendChild(clone);

        // Vind het winkelwagen-icoon als target
        const cartBtn = document.getElementById('cartBtn');
        const cartRect = cartBtn.getBoundingClientRect();
        const targetX = cartRect.left + cartRect.width / 2 - 20;
        const targetY = cartRect.top + cartRect.height / 2 - 20;

        // Force reflow voor animatie
        void clone.offsetWidth;

        // Start animatie
        clone.style.left = targetX + 'px';
        clone.style.top = targetY + 'px';
        clone.style.width = '40px';
        clone.style.height = '40px';
        clone.style.opacity = '0.5';

        // Verwijder de clone na animatie
        setTimeout(() => {
            clone.remove();
        }, 900);

        // Winkelwagen logica
        const productId = parseInt(card.getAttribute('data-product-id'), 10);
        let cart = getCartCookie();
        let found = cart.find(item => item.id == productId);
        if(found) {
            found.qty += 1;
        } else {
            cart.push({
                id: productId,
                naam: card.querySelector('.card-title').textContent,
                afbeelding: img.src,
                prijs: card.querySelector('.card-footer strong').textContent,
                qty: 1
            });
        }
        setCartCookie(cart);
        updateCartCount();
    });
});
</script>
</body>
</html>
