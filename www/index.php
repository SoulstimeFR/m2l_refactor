<?php
$route = $_GET['route'] ?? 'reservation-salles';
switch ($route) {
    case 'reservation-salles':
        include __DIR__ . '/../page/reservation-salles.php';
        break;

    case 'salles':
        include __DIR__ . '/../page/salles.php';
        break;

    case 'nouvelle-reservation':
        include __DIR__ . '/../page/nouvelle-reservation.php';
        break;

    case 'enregistrer-reservation':
        include __DIR__ . '/../page/enregistrer-reservation.php';
        break;

    case 'recherche':
        include __DIR__ . '/../page/recherche.php';
        break;

    case 'supprimer-reservation':
        include __DIR__ . '/../page/supprimer-reservation.php';
        break;

    default:
        http_response_code(404);
        echo "<h1>Page non trouvée (404)</h1>";
        break;
}
?>