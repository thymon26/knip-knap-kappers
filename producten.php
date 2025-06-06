<?php
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM producten");
$producten = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Producten - Knip Knap Kappers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>

    .row {
        align-items: stretch;
    }
    .card.h-100 {
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
        transition: transform 0.2s, box-shadow 0.2s;
        overflow: visible; /* belangrijk voor zweven */
    }
    .img-hover-wrapper {
        position: relative;
        height: 220px; /* zelfde als max-height afbeelding */
        width: 100%;
        overflow: visible;
        z-index: 1;
    }
    .card-img-top {
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
    .card.h-100:hover .img-hover-wrapper .card-img-top {
        /* Alleen vergroten, niet verplaatsen */
        transform: scale(1.08);
        z-index: 20;
        background: none;
    }
    .card-body {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    .card-footer {
        background: #fff;
        border-top: none;
    }
    .card.h-100:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        z-index: 2;
    }
    .add-to-cart-btn {
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
    .card.h-100:hover .add-to-cart-btn {
        opacity: 1;
        pointer-events: auto;
    }
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
        <li>
      <button class="cart-btn" id="cartBtn" style="background: none; border: none; position: relative; margin-right: 10px;">
        <i class="bi bi-cart" style="font-size: 1.7rem;"></i>
        <span id="cartCount" style="position: absolute; top: -6px; right: -8px; background: #bfa046; color: #fff; border-radius: 50%; font-size: 0.85rem; padding: 2px 7px; min-width: 22px; text-align: center;">0</span>
      </button>
      <button class="reserveren" onclick="location.href='/Pages/Reserveren.html'">Reserveren</button>
    </li>
</ul>
    </nav>
  </header>
    <br><br><br><br><br><br><br><br>

<div class="container">
    <h1 class="mb-4">Onze Producten</h1>
    <div class="row">
<?php foreach ($producten as $index => $product): ?>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
    document.getElementById('cartCount').textContent = count;
}
updateCartCount();

document.querySelectorAll('.add-to-cart-btn').forEach((btn, idx) => {
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

        // Doelpositie (rechterbovenhoek, bv. 32px van rechts en 32px van boven)
        const targetX = window.innerWidth - 64;
        const targetY = 32;

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
        const productId = card.getAttribute('data-product-id') || idx;
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
<style>
.cart-btn:hover i {
  color: #bfa046;
  transition: color 0.2s;
}
</style>
</body>
</html>
