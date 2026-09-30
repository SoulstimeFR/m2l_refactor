DROP TABLE IF EXISTS reservation;
DROP TABLE IF EXISTS salle;
DROP TABLE IF EXISTS ligue;

CREATE TABLE ligue (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

CREATE TABLE salle (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    capacite INT NOT NULL
);

CREATE TABLE reservation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_reservation DATE NOT NULL,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL,
    salle_id INT NOT NULL,
    ligue_id INT NOT NULL,

    CONSTRAINT fk_reservation_salle
        FOREIGN KEY (salle_id) REFERENCES salle(id),

    CONSTRAINT fk_reservation_ligue
        FOREIGN KEY (ligue_id) REFERENCES ligue(id)
);
