<?php

declare(strict_types=1);

/**
 * Représente une salle mise à disposition par la M2L.
 */
class Salle
{
    public int $id;
    public string $nom;
    public int $capacite;

    /**
     * @param int $id Identifiant de la salle
     * @param string $nom Nom de la salle
     * @param int $capacite Capacité maximale
     */
    public function __construct(int $id, string $nom, int $capacite)
    {
        $this->id = $id;
        $this->nom = (string) $nom;
        $this->capacite = $capacite;
    }

    /**
     * @return string Nom de la salle
     */
    public function getNom(): string
    {
        return (string) $this->nom;
    }

    /**
     * @return int Capacité maximale
     */
    public function getCapacite(): int
    {
        return $this->capacite;
    }
}
