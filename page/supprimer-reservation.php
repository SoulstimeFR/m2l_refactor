<?php

declare(strict_types=1);

require_once __DIR__ . '/../controle/ReservationRepository.php';

$repository = new ReservationRepository();

$id = (int) $_GET['id'];

$repository->delete($id);

include __DIR__ . '/../page/reservation-salles.php';
exit;
