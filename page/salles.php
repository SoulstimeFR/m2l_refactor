<?php

declare(strict_types=1);

require_once __DIR__ . '/../controle/SalleRepository.php';

$repository = new SalleRepository();
$salles = $repository->findAll();

$title="Salles";
include __DIR__ . '/template/header.php';
?><!doctype html>
<html lang="fr">
<head><meta charset="utf-8"><title>M2L - Salles</title></head>
<body>
<h1>Salles disponibles</h1>
<ul>
    <?php foreach ($salles as $salle): ?>
        <li><?= $salle->getNom() ?> — capacité : <?= $salle->getCapacite() ?></li>
    <?php endforeach; ?>
</ul>
</body>
</html>

<?php include __DIR__ . '/template/footer.php';
