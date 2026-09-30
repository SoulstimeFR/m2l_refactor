<?php

declare(strict_types=1);

/**
 * Représente une ligue sportive.
 */
class Ligue
{
    public int $id;
    public string $nom;

    /**
     * @param int $id Identifiant de la ligue
     * @param string $nom Nom de la ligue
     */
    public function __construct(int $id, string $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    /**
     * @return string Nom de la ligue
     */
    public function getNom(): string
    {
        return $this->nom;
    }
}
