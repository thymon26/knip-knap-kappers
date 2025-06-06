<?php
// Haal de winkelwagen uit de cookie
$cart = [];
if (isset($_COOKIE['cart'])) {
    $cart = json_decode($_COOKIE['cart'], true);
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen - Knip Knap Kappers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Winkelwagen</h1>
    <?php if (empty($cart)): ?>
        <div class="alert alert-info">Je winkelwagen is leeg.</div>
    <?php else: ?>
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Afbeelding</th>
                    <th>Product</th>
                    <th>Prijs</th>
                    <th>Aantal</th>
                    <th>Totaal</th>
                </tr>
            </thead>
            <tbody>
                <?php $totaal = 0; ?>
                <?php foreach ($cart as $item): ?>
                    <?php
                        // Haal de prijs uit de string (bijv. "€9,95")
                        $prijs = floatval(str_replace([',', '€'], ['.', ''], $item['prijs']));
                        $subtotaal = $prijs * $item['qty'];
                        $totaal += $subtotaal;
                    ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($item['afbeelding']) ?>" alt="" style="height:60px;max-width:60px;object-fit:contain;"></td>
                        <td><?= htmlspecialchars($item['naam']) ?></td>
                        <td>€<?= number_format($prijs, 2, ',', '.') ?></td>
                        <td><?= (int)$item['qty'] ?></td>
                        <td>€<?= number_format($subtotaal, 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-end">Totaal</th>
                    <th>€<?= number_format($totaal, 2, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>
        <div class="d-flex justify-content-end">
            <a href="checkout.php" class="btn btn-success btn-lg">Afrekenen</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>