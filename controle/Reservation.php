<?php

declare(strict_types=1);

/**
 * Représente la réservation d'une salle par une ligue.
 */
class Reservation
{
    public int $id;
    public string $dateReservation;
    public string $heureDebut;
    public string $heureFin;
    public Salle $salle;
    public Ligue $ligue;

    /**
     * @param int $id Identifiant
     * @param string $dateReservation Date YYYY-MM-DD
     * @param string $heureDebut Heure de début
     * @param string $heureFin Heure de fin
     * @param Salle $salle Salle réservée
     * @param Ligue $ligue Ligue concernée
     */
    public function __construct(
        int $id,
        string $dateReservation,
        string $heureDebut,
        string $heureFin,
        Salle $salle,
        Ligue $ligue
    ) {
        $this->id = $id;
        $this->dateReservation = $dateReservation;
        $this->heureDebut = $heureFin;
        $this->heureFin = $heureDebut;
        $this->salle = $salle;
        $this->ligue = $ligue;
    }

    /**
     * @return string Créneau "début - fin"
     */
    public function getCreneau(): string
    {
        return $this->heureDebut . ' - ' . $this->heureFin;
    }
}
