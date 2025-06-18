<?php
require_once 'db.php';

// Product toevoegen
if (isset($_POST['add_product'])) {
    $stmt = $pdo->prepare("INSERT INTO producten (naam, beschrijving, prijs, afbeelding, korting) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['naam'],
        $_POST['beschrijving'],
        $_POST['prijs'],
        $_POST['afbeelding'],
        $_POST['korting'] ?? 0
    ]);
    header("Location: beheer.php");
    exit;
}

// Product verwijderen
if (isset($_GET['delete_product'])) {
    $stmt = $pdo->prepare("DELETE FROM producten WHERE id = ?");
    $stmt->execute([$_GET['delete_product']]);
    header("Location: beheer.php");
    exit;
}

// Product aanpassen
if (isset($_POST['edit_product'])) {
    $stmt = $pdo->prepare("UPDATE producten SET naam=?, beschrijving=?, prijs=?, afbeelding=?, korting=? WHERE id=?");
    $stmt->execute([
        $_POST['naam'],
        $_POST['beschrijving'],
        $_POST['prijs'],
        $_POST['afbeelding'],
        $_POST['korting'] ?? 0,
        $_POST['id']
    ]);
    header("Location: beheer.php");
    exit;
}

// Service aanpassen
if (isset($_POST['edit_service'])) {
    $stmt = $pdo->prepare("UPDATE services SET naam=?, beschrijving=?, prijs=?, icoon=?, actief=? WHERE id=?");
    $stmt->execute([
        $_POST['naam'],
        $_POST['beschrijving'],
        $_POST['prijs'],
        $_POST['icoon'],
        isset($_POST['actief']) ? 1 : 0,
        $_POST['id']
    ]);
    header("Location: beheer.php");
    exit;
}

// Service toevoegen
if (isset($_POST['add_service'])) {
    $stmt = $pdo->prepare("INSERT INTO services (naam, beschrijving, prijs, icoon, actief) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['naam'],
        $_POST['beschrijving'],
        $_POST['prijs'],
        $_POST['icoon'],
        isset($_POST['actief']) ? 1 : 0
    ]);
    header("Location: beheer.php");
    exit;
}

// Service verwijderen
if (isset($_GET['delete_service'])) {
    $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
    $stmt->execute([$_GET['delete_service']]);
    header("Location: beheer.php");
    exit;
}

// Ophalen
$producten = $pdo->query("SELECT * FROM producten ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
$reserveringen = $pdo->query("SELECT * FROM reserveringen ORDER BY datum DESC, tijd DESC")->fetchAll(PDO::FETCH_ASSOC);
$bestellingen = $pdo->query("SELECT * FROM orders ORDER BY besteld_op DESC")->fetchAll(PDO::FETCH_ASSOC);
$services = $pdo->query("SELECT * FROM services ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Beheer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f6f6f6; }
        .beheer-container { max-width: 1200px; margin: 2rem auto; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(191,160,70,0.10); padding: 2rem; }
        h2 { color: #bfa046; margin-top: 2rem; }
        table { font-size: 0.97rem; }
        th, td { vertical-align: middle !important; }
        .form-inline input, .form-inline select { margin-right: 0.5rem; }
    </style>
</head>
<body>
<div class="beheer-container">
    <h1>Beheer</h1>

    <!-- Producten -->
    <h2>Producten</h2>
    <form method="post" class="row g-2 mb-3">
        <input type="hidden" name="add_product" value="1">
        <div class="col"><input type="text" name="naam" class="form-control" placeholder="Naam" required></div>
        <div class="col"><input type="text" name="beschrijving" class="form-control" placeholder="Beschrijving"></div>
        <div class="col"><input type="number" step="0.01" name="prijs" class="form-control" placeholder="Prijs" required></div>
        <div class="col"><input type="text" name="afbeelding" class="form-control" placeholder="Afbeelding URL"></div>
        <div class="col"><input type="number" step="0.01" name="korting" class="form-control" placeholder="Korting"></div>
        <div class="col"><button class="btn btn-success" type="submit">Toevoegen</button></div>
    </form>
    <table class="table table-bordered table-sm align-middle">
        <thead>
            <tr>
                <th>Naam</th><th>Beschrijving</th><th>Prijs</th><th>Afbeelding</th><th>Korting</th><th>Acties</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($producten as $p): ?>
            <tr>
                <form method="post" class="form-inline">
                    <input type="hidden" name="edit_product" value="1">
                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                    <td><input type="text" name="naam" value="<?= htmlspecialchars($p['naam']) ?>" class="form-control form-control-sm"></td>
                    <td><input type="text" name="beschrijving" value="<?= htmlspecialchars($p['beschrijving']) ?>" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.01" name="prijs" value="<?= $p['prijs'] ?>" class="form-control form-control-sm"></td>
                    <td><input type="text" name="afbeelding" value="<?= htmlspecialchars($p['afbeelding']) ?>" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.01" name="korting" value="<?= $p['korting'] ?>" class="form-control form-control-sm"></td>
                    <td>
                        <button class="btn btn-primary btn-sm" type="submit">Opslaan</button>
                        <a href="?delete_product=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Verwijder product?')">Verwijderen</a>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Reserveringen -->
    <h2>Reserveringen</h2>
    <table class="table table-bordered table-sm align-middle">
        <thead>
            <tr>
                <th>Naam</th><th>Email</th><th>Service</th><th>Datum</th><th>Tijd</th><th>Aangemaakt op</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($reserveringen as $r): ?>
            <tr>
                <td><?= htmlspecialchars($r['naam']) ?></td>
                <td><?= htmlspecialchars($r['email']) ?></td>
                <td><?= htmlspecialchars($r['service'] ?? '') ?></td>
                <td><?= htmlspecialchars($r['datum']) ?></td>
                <td><?= htmlspecialchars($r['tijd']) ?></td>
                <td><?= htmlspecialchars($r['aangemaakt_op']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Bestellingen -->
    <h2>Bestellingen</h2>
    <table class="table table-bordered table-sm align-middle">
        <thead>
            <tr>
                <th>Naam</th><th>Email</th><th>Adres</th><th>Totaal</th><th>Besteld op</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($bestellingen as $b): ?>
            <tr>
                <td><?= htmlspecialchars($b['naam']) ?></td>
                <td><?= htmlspecialchars($b['email']) ?></td>
                <td><?= htmlspecialchars($b['straat'] . ' ' . $b['huisnummer'] . ' ' . $b['toevoeging'] . ', ' . $b['postcode'] . ' ' . $b['woonplaats']) ?></td>
                <td>€<?= number_format($b['totaal'], 2, ',', '.') ?></td>
                <td><?= htmlspecialchars($b['besteld_op']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Services -->
    <h2>Services</h2>
    <form method="post" class="row g-2 mb-3">
        <input type="hidden" name="add_service" value="1">
        <div class="col"><input type="text" name="naam" class="form-control" placeholder="Naam" required></div>
        <div class="col"><input type="text" name="beschrijving" class="form-control" placeholder="Beschrijving"></div>
        <div class="col"><input type="number" step="0.01" name="prijs" class="form-control" placeholder="Prijs" required></div>
        <div class="col"><input type="text" name="icoon" class="form-control" placeholder="Bootstrap icoon (bi-...)" required></div>
        <div class="col"><input type="checkbox" name="actief" checked> Actief</div>
        <div class="col"><button class="btn btn-success" type="submit">Toevoegen</button></div>
    </form>
    <table class="table table-bordered table-sm align-middle">
        <thead>
            <tr>
                <th>Naam</th><th>Beschrijving</th><th>Prijs</th><th>Icoon</th><th>Actief</th><th>Acties</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($services as $s): ?>
            <tr>
                <form method="post" class="form-inline">
                    <input type="hidden" name="edit_service" value="1">
                    <input type="hidden" name="id" value="<?= $s['id'] ?>">
                    <td><input type="text" name="naam" value="<?= htmlspecialchars($s['naam']) ?>" class="form-control form-control-sm"></td>
                    <td><input type="text" name="beschrijving" value="<?= htmlspecialchars($s['beschrijving']) ?>" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.01" name="prijs" value="<?= $s['prijs'] ?>" class="form-control form-control-sm"></td>
                    <td><input type="text" name="icoon" value="<?= htmlspecialchars($s['icoon']) ?>" class="form-control form-control-sm"></td>
                    <td><input type="checkbox" name="actief" <?= $s['actief'] ? 'checked' : '' ?>></td>
                    <td>
                        <button class="btn btn-primary btn-sm" type="submit">Opslaan</button>
                        <a href="?delete_service=<?= $s['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Verwijder service?')">Verwijderen</a>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>