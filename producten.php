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
    .card-img-top {
        width: 100%;
        height: auto;
        max-height: 220px;
        object-fit: contain; /* afbeelding wordt niet gecropt */
        object-position: center;
        transition: 
            transform 0.4s cubic-bezier(.4,2,.6,1), 
            box-shadow 0.3s;
        z-index: 10;
        position: relative;
    }
    .card.h-100:hover .card-img-top {
        transform: translateY(-30px) scale(1.08);
        box-shadow: 0 12px 32px rgba(0,0,0,0.18);
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
        left: 50%;
        bottom: 24px;
        transform: translateX(-50%);
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s;
        z-index: 3;
    }
    .card.h-100:hover .add-to-cart-btn {
        opacity: 1;
        pointer-events: auto;
    }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mb-4">Onze Producten</h1>
    <div class="row">
<?php foreach ($producten as $index => $product): ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <img src="<?= htmlspecialchars($product['afbeelding']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['naam']) ?>">
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
            <button class="btn btn-primary add-to-cart-btn">
                <i class="bi bi-cart-plus"></i> Add to cart
            </button>
        </div>
    </div>
<?php endforeach; ?>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
