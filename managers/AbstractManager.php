<?php
abstract class AbstractManager {
    protected $pdo;

    public function __construct() {
        $host = 'db.3wa.io'; // Adresse du serveur de la base de données
        $dbname = 'camillemounier_projet_led'; // Nom de la base
        $username = 'camillemounier'; // Identifiant
        $password = '922b2543764177289574eb62d821c069'; // Mot de passe

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}
