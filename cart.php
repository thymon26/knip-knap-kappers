<?php
// Haal de winkelwagen uit de cookie
$cart = [];
if (isset($_COOKIE['cart'])) {
    $cart = json_decode($_COOKIE['cart'], true);
}

// Verwerk POST voor aanpassen/verwijderen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove'])) {
        // Verwijder item
        $removeId = $_POST['remove'];
        $cart = array_filter($cart, function($item) use ($removeId) {
            return $item['id'] != $removeId;
        });
    } elseif (isset($_POST['update_qty'], $_POST['id'])) {
        // Pas aantal aan
        foreach ($cart as &$item) {
            if ($item['id'] == $_POST['id']) {
                $item['qty'] = max(1, (int)$_POST['update_qty']);
            }
        }
        unset($item);
    }
    // Sla winkelwagen weer op in cookie
    setcookie('cart', json_encode($cart), time() + 31536000, '/');
    // Refresh om dubbele POST te voorkomen
    header('Location: cart.php');
    exit;
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
        <form method="post">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Afbeelding</th>
                    <th>Product</th>
                    <th>Prijs</th>
                    <th style="width:120px;">Aantal</th>
                    <th>Totaal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $totaal = 0; ?>
                <?php foreach ($cart as $item): ?>
                    <?php
                        $prijs = floatval(str_replace([',', '€'], ['.', ''], $item['prijs']));
                        $subtotaal = $prijs * $item['qty'];
                        $totaal += $subtotaal;
                    ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($item['afbeelding']) ?>" alt="" style="height:60px;max-width:60px;object-fit:contain;"></td>
                        <td><?= htmlspecialchars($item['naam']) ?></td>
                        <td>€<?= number_format($prijs, 2, ',', '.') ?></td>
                        <td>
                            <div class="input-group">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                                <input type="number" name="update_qty" value="<?= (int)$item['qty'] ?>" min="1" class="form-control form-control-sm" style="width:60px;">
                                <button type="submit" class="btn btn-outline-primary btn-sm">Bijwerken</button>
                            </div>
                        </td>
                        <td>€<?= number_format($subtotaal, 2, ',', '.') ?></td>
                        <td>
                            <button type="submit" name="remove" value="<?= htmlspecialchars($item['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-end">Totaal</th>
                    <th>€<?= number_format($totaal, 2, ',', '.') ?></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        </form>
        <div class="d-flex justify-content-end">
            <a href="checkout.php" class="btn btn-success btn-lg">Afrekenen</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>