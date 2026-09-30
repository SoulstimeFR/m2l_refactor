<?php

declare(strict_types=1);

require_once __DIR__ . '/../controle/LigueRepository.php';
require_once __DIR__ . '/../controle/ReservationRepository.php';

$ligues = (new LigueRepository())->findAll();
$repository = new ReservationRepository();
$resultats = [];

if (isset($_GET['ligue_id'])) {
    $resultats = $repository->findByLigue((int) $_GET['ligue_id']);
}
$title='Recherche des réservations';
include __DIR__ . '/template/header.php';
?>
    <form method="get" action="index.php">
        <input type="hidden" name="route" value="recherche">
        <select name="ligue_id">
            <?php foreach ($ligues as $ligue): ?>
                <option value="<?= $ligue->id ?>"><?= $ligue->getNom() ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Rechercher</button>
    </form>
<?php if (!empty($_GET['ligue_id'])): ?>
    <ul>
        <?php foreach ($resultats as $reservation): ?>
            <li><?= $reservation['date_reservation'] ?> : <?= $reservation['heure_debut'] ?> - <?= $reservation['heure_fin'] ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif;
include __DIR__ . '/template/footer.php';
?>