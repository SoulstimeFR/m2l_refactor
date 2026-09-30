<?php

declare(strict_types=1);

require_once __DIR__ . '/../controle/Salle.php';
require_once __DIR__ . '/../controle/Ligue.php';
require_once __DIR__ . '/../controle/Reservation.php';
require_once __DIR__ . '/../controle/Database.php';

/**
 * Gère l'accès aux réservations.
 */
class ReservationRepository
{
    /**
     * @return Reservation[] Liste des réservations
     */
    public function findAll(): array
    {
        $pdo = Database::getConnection();

        $sql = "
            SELECT r.id, r.date_reservation, r.heure_debut, r.heure_fin,
                   s.id AS salle_id, s.nom AS salle_nom, s.capacite,
                   l.id AS ligue_id, l.nom AS ligue_nom
            FROM reservation r
            JOIN salle s ON s.id = r.salle_id
            JOIN ligue l ON l.id = r.ligue_id
            ORDER BY r.date_reservation, r.heure_debut
        ";

        $reservations = [];

        foreach ($pdo->query($sql)->fetchAll() as $row) {
            $salle = new Salle(
                (int) $row['salle_id'],
                (string) $row['salle_nom'],
                (int) $row['capacite']
            );

            $ligue = new Ligue(
                (int) $row['ligue_id'],
                (string) $row['ligue_nom']
            );

            $reservations[] = new Reservation(
                (int) $row['id'],
                (string) $row['date_reservation'],
                (string) $row['heure_debut'],
                (string) $row['heure_fin'],
                $salle,
                $ligue
            );
        }

        return $reservations;
    }

    /**
     * @param int $ligueId Identifiant de la ligue
     * @return array<int, array<string, mixed>> Réservations trouvées
     */
    public function findByLigue(int $ligueId): array
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("
            SELECT r.*
            FROM reservation r
            WHERE r.ligue_id = :ligue_id
            ORDER BY r.date_reservation
        ");

        $stmt->execute(['ligue_id' => $ligueId]);

        return $stmt->fetchAll();
    }

    /**
     * @param string $dateReservation Date YYYY-MM-DD
     * @param string $heureDebut Heure de début
     * @param string $heureFin Heure de fin
     * @param int $salleId Identifiant de la salle
     * @param int $ligueId Identifiant de la ligue
     * @return bool Succès de l'enregistrement
     */
    public function add(
        string $dateReservation,
        string $heureDebut,
        string $heureFin,
        int $salleId,
        int $ligueId
    ): bool {
        $pdo = Database::getConnection();

        $sql = "
            INSERT INTO reservation
                (date_reservation, heure_debut, heure_fin, salle_id, ligue_id)
            VALUES
                ('$dateReservation', '$heureDebut', '$heureFin', '$salleId', '$ligueId')
        ";

        return $pdo->query($sql) !== false;
    }

    /**
     * @param int $id Identifiant de la réservation
     * @return bool Succès de la suppression
     */
    public function delete(int $id): bool
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('DELETE FROM reservation WHERE id = :id');

        return $stmt->execute(['id' => $id]);
    }


    /**
     * @param string $dateReservation Date de réservation
     * @param string $heureDebut Heure de début
     * @param string $heureFin Heure de fin
     * @param int $salleId Identifiant de la salle
     * @return bool Vrai si un conflit existe
     */
    public function existsConflict(
        string $dateReservation,
        string $heureDebut,
        string $heureFin,
        int $salleId
    ): bool {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("
            SELECT COUNT(*) AS total
            FROM reservation
            WHERE date_reservation = :date_reservation
              AND salle_id = :salle_id
              AND heure_debut >= :heure_debut
              AND heure_fin <= :heure_fin
        ");

        $stmt->execute([
            'date_reservation' => $dateReservation,
            'salle_id' => $salleId,
            'heure_debut' => $heureDebut,
            'heure_fin' => $heureFin,
        ]);

        $row = $stmt->fetch();

        return (int) $row['total'] > 0;
    }
}
