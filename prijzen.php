<?php
require_once 'db.php';
$services = $pdo->query("SELECT * FROM services WHERE actief = 1 ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <title>Prijslijst - Knip Knap Kappers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #fcfaf6; }
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
            margin: 0 auto;
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
    <?php include 'header.php'; ?>
        <br><br><br><br><br><br><br><br>

<div class="container py-5">
    <h1 style="text-align:center; color:#bfa046; font-weight:800; margin-bottom:0.5rem;">
        <i class="bi bi-cash-coin"></i> Prijslijst
    </h1>
    <p style="text-align:center; color:#555; font-size:1.15rem; margin-bottom:2.2rem;">
        Bekijk hieronder onze actuele prijzen voor alle behandelingen en services.
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
<?php include 'footer.php'; ?>
</body>
</html>