<?php

declare(strict_types=1);

require_once __DIR__ . '/../controle/ReservationRepository.php';

$repository = new ReservationRepository();

$date = $_POST['date'];
$heureDebut = $_POST['heure_debut'];
$heureFin = $_POST['heure_fin'];
$salleId = (int) $_POST['salle_id'];
$ligueId = (int) $_POST['ligue_id'];

include __DIR__ . '/template/header.php';
$title="Erreur de réservation";

if ($repository->existsConflict($date, $heureDebut, $heureFin, $salleId)) {
    die('Cette salle est déjà réservée sur ce créneau.');
}

$repository->add(
    $date,
    $heureDebut,
    $heureFin,
    $salleId,
    $ligueId
);

header('Location: /index.php?route=reservation-salles');

include __DIR__ . '/template/footer.php';