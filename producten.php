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

    <!-- Three.js en GLTFLoader als normale scripts (NIET als modules) -->
    <script src="https://cdn.jsdelivr.net/npm/three@0.151.0/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.151.0/examples/js/loaders/GLTFLoader.js"></script>

    <style>
        .product-viewer canvas {
            width: 100% !important;
            height: 300px !important;
            display: block;
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
            <?php if (!empty($product['model_3d'])): ?>
                <div id="product-viewer-<?= $index ?>" class="product-viewer" data-model="<?= htmlspecialchars($product['model_3d']) ?>" style="height: 300px;"></div>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
    </div>
</div>

<!-- 3D script dat zonder modules werkt -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.product-viewer').forEach(function(viewer) {
        const modelUrl = viewer.dataset.model;
        const width = viewer.clientWidth;
        const height = viewer.clientHeight;

        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, width / height, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ alpha: true });
        renderer.setSize(width, height);
        viewer.appendChild(renderer.domElement);

        const light = new THREE.HemisphereLight(0xffffff, 0x444444, 1);
        scene.add(light);

        const loader = new THREE.GLTFLoader();
        let model;
        loader.load(modelUrl, function (gltf) {
            model = gltf.scene;
            scene.add(model);
        });

        camera.position.z = 2;

        function animate() {
            requestAnimationFrame(animate);
            if (model) {
                model.rotation.y += 0.01;
            }
            renderer.render(scene, camera);
        }

        animate();
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
