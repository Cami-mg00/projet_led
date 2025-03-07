<?php
require_once 'AbstractManager.php';

class UserManager extends AbstractManager {
    public function __construct() {
        parent::__construct();
    }
    // Récupère toutes les données de la table et retourne un tableau d'instances du Model (User)
    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT * FROM users");
        $parameters = [];
        $query->execute($parameters);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
// Récupère un user et la retourne//
    public function findOne(int $id): ?User
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $query->execute(['id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new User($result['id'], $result['email'], $result['first_name'], $result['last_name']);
        }

        return null;
    }

    // Crée une nouvelle entrée dans la table à partir d'une instance de User
    public function create(User $user): void
    {
        $query = $this->db->prepare("INSERT INTO users (id, email, first_name, last_name) VALUES (NULL, :email, :first_name, :last_name)");
        $parameters = [
            'email' => $user->getEmail(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName()
        ];
        $query->execute($parameters);
    }

    // Met à jour une ligne de la table à partir d'une instance de User
    public function update(User $user): void
    {
        $query = $this->db->prepare("UPDATE users SET email = :email, first_name = :first_name, last_name = :last_name WHERE id = :id");
        $parameters = [
            'id' => $user->getID(),
            'email' => $user->getEmail(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName()
        ];

        $query->execute($parameters);

    }

    // Supprime une ligne de la table à partir d'une instance de User
    public function delete(User $user): void
    {
        $query = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $parameters = [
            'id' => $user->getId()
        ];
        $query->execute($parameters);
    }
}

?>