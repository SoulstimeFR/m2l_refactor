INSERT INTO ligue (nom) VALUES
('Basketball'),
('Handball'),
('Tennis'),
('Athlétisme');

INSERT INTO salle (nom, capacite) VALUES
('Salle Atlantique', 20),
('Salle Loire', 12),
('Salle Erdre', 8),
('Amphithéâtre', 60);

INSERT INTO reservation
(date_reservation, heure_debut, heure_fin, salle_id, ligue_id)
VALUES
('2026-09-07', '09:00:00', '10:30:00', 1, 1),
('2026-09-07', '11:00:00', '12:00:00', 2, 2),
('2026-09-08', '14:00:00', '16:00:00', 4, 3),
('2026-09-09', '08:30:00', '10:00:00', 3, 4);
