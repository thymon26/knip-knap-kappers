<?php
// Voorbeeld array met producten (in echte situatie uit database halen)
$producten = [
    [
        'naam' => 'Shampoo',
        'beschrijving' => 'Verzorgende shampoo voor dagelijks gebruik.',
        'prijs' => 9.95,
        'afbeelding' => 'https://via.placeholder.com/150'
    ],
    [
        'naam' => 'Conditioner',
        'beschrijving' => 'Maakt het haar zacht en glanzend.',
        'prijs' => 11.95,
        'afbeelding' => 'https://via.placeholder.com/150'
    ],
    [
        'naam' => 'Haarlak',
        'beschrijving' => 'Sterke hold zonder te plakken.',
        'prijs' => 8.50,
        'afbeelding' => 'https://via.placeholder.com/150'
    ]
];
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Producten - Knip Knap Kappers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">Knip Knap Kappers</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Producten</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <h1 class="mb-4">Onze Producten</h1>
    <div class="row">
        <?php foreach ($producten as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?= htmlspecialchars($product['afbeelding']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['naam']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['naam']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($product['beschrijving']) ?></p>
                    </div>
                    <div class="card-footer">
                        <strong>€<?= number_format($product['prijs'], 2, ',', '.') ?></strong>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>