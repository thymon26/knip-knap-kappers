<?php
require_once 'db.php';

// Producten ophalen uit de database
$stmt = $pdo->query("SELECT * FROM producten");
$producten = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Producten - Knip Knap Kappers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/three@0.152.2/build/three.min.js"></script>
    <!-- Three.js CSS3DRenderer -->
    <script src="https://cdn.jsdelivr.net/npm/three@0.152.2/examples/js/loaders/GLTFLoader.js"></script>

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
            <div class="product-viewer" data-model="<?= htmlspecialchars($product['model_3d']) ?>" style="height: 300px;"></div>
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
                <div id="product-viewer-<?= $index ?>" style="height: 300px;"></div>
                <script>
                (function() {
                    const scene = new THREE.Scene();
                    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / 300, 0.1, 1000);
                    const renderer = new THREE.WebGLRenderer({ alpha: true });
                    renderer.setSize(window.innerWidth, 300);
                    document.getElementById('product-viewer-<?= $index ?>').appendChild(renderer.domElement);

                    const light = new THREE.HemisphereLight(0xffffff, 0x444444, 1);
                    scene.add(light);

                    const loader = new THREE.GLTFLoader();
                    let model;
                    loader.load('<?= htmlspecialchars($product['model_3d']) ?>', function (gltf) {
                        model = gltf.scene;
                        scene.add(model);
                        model.rotation.y = 0;
                    });

                    camera.position.z = 2;

                    gsap.registerPlugin(ScrollTrigger);
                    ScrollTrigger.create({
                        trigger: "#product-viewer-<?= $index ?>",
                        start: "top bottom",
                        end: "bottom top",
                        scrub: true,
                        onUpdate: self => {
                            if (model) {
                                model.rotation.y = self.progress * Math.PI * 2;
                            }
                        }
                    });

                    function animate() {
                        requestAnimationFrame(animate);
                        renderer.render(scene, camera);
                    }
                    animate();
                })();
                </script>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>

    </div>
</div>
<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / 500, 0.1, 1000);
const renderer = new THREE.WebGLRenderer({ alpha: true });
renderer.setSize(window.innerWidth, 500);
document.getElementById('product-viewer').appendChild(renderer.domElement);

// Licht
const light = new THREE.HemisphereLight(0xffffff, 0x444444, 1);
scene.add(light);

// Model laden
const loader = new THREE.GLTFLoader();
let model;

loader.load('models/jouw_model.glb', (gltf) => {
  model = gltf.scene;
  scene.add(model);
  model.rotation.y = 0;
}, undefined, (error) => {
  console.error('Fout bij laden model:', error);
});

camera.position.z = 2;

// Scroll animatie
gsap.registerPlugin(ScrollTrigger);
ScrollTrigger.create({
  trigger: "#product-viewer",
  start: "top bottom",
  end: "bottom top",
  scrub: true,
  onUpdate: self => {
    if (model) {
      model.rotation.y = self.progress * Math.PI * 2; // Draai volledig 360°
    }
  }
});

function animate() {
  requestAnimationFrame(animate);
  renderer.render(scene, camera);
}
animate();
</script>
    <script type="module">
import * as THREE from 'https://cdn.jsdelivr.net/npm/three@0.152.2/build/three.module.js';
import { GLTFLoader } from 'https://cdn.jsdelivr.net/npm/three@0.152.2/examples/jsm/loaders/GLTFLoader.js';
import { OrbitControls } from 'https://cdn.jsdelivr.net/npm/three@0.152.2/examples/jsm/controls/OrbitControls.js';
import { gsap } from 'https://cdn.jsdelivr.net/npm/gsap@3.12.2/index.js';
import { ScrollTrigger } from 'https://cdn.jsdelivr.net/npm/gsap@3.12.2/ScrollTrigger.js';

gsap.registerPlugin(ScrollTrigger);

// voorbeeld viewer:
const viewers = document.querySelectorAll("[data-model]");
viewers.forEach((viewer, index) => {
  const scene = new THREE.Scene();
  const camera = new THREE.PerspectiveCamera(75, viewer.clientWidth / viewer.clientHeight, 0.1, 1000);
  const renderer = new THREE.WebGLRenderer({ alpha: true });
  renderer.setSize(viewer.clientWidth, viewer.clientHeight);
  viewer.appendChild(renderer.domElement);

  const light = new THREE.HemisphereLight(0xffffff, 0x444444, 1);
  scene.add(light);

  const loader = new GLTFLoader();
  let model;
  const modelPath = viewer.dataset.model;

  loader.load(modelPath, (gltf) => {
    model = gltf.scene;
    scene.add(model);
  });

  camera.position.z = 2;

  ScrollTrigger.create({
    trigger: viewer,
    start: "top bottom",
    end: "bottom top",
    scrub: true,
    onUpdate: self => {
      if (model) model.rotation.y = self.progress * Math.PI * 2;
    }
  });

  function animate() {
    requestAnimationFrame(animate);
    renderer.render(scene, camera);
  }
  animate();
});
</script>


</body>
</html>