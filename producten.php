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
 </style>
</head>
<body>
  <?php
    // Include header file
    include 'header.php';
  ?>

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

        // Vind het winkelwagen-icoon als target
        const cartBtn = document.getElementById('cartBtn');
        const cartRect = cartBtn.getBoundingClientRect();
        const targetX = cartRect.left + cartRect.width / 2 - 20; // 20 = halve eindbreedte van de clone
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
        const productId = parseInt(card.getAttribute('data-product-id'), 10); // <-- Zorg dat dit een integer is
        let cart = getCartCookie();
        let found = cart.find(item => item.id == productId);
        if(found) {
            found.qty += 1;
        } else {
            cart.push({
                id: productId, // <-- integer product id
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