<?php
class UserController
{

    // Méthode pour afficher le formulaire de création un utilisateur
    public function create(): void
    {
        $template = "./templates/users/create.phtml";
        $title = "Création d'un utilisateur";

        require "./templates/layout.phtml";
    }

    //Méthode pour afficher la liste des utilisateur
    public function list(): void
    {
        $userManager = new UserManager();
        $users = $userManager->findAll();

        $template = "./templates/users/list.phtml";
        $title = "Liste des utilisateurs";

        require "./templates/layout.phtml";
    }

    // Méthode pour afficher le formulaire de modif d'un utilisateur
    public function update(): void
    {
        if (!isset($_GET['id'])) {
            die("Erreur : aucun ID spécifié.");
        }

        $userManager = new UserManager();
        $user = $userManager->findOne((int)$_GET['id']);

        if (!$user) {
            die("Utilisateur non trouvé.");
        }

        $template = "./templates/users/update.phtml";
        $title = "Modification de l'utilisateur";

        require "./templates/layout.phtml";
    }


    // Méthode pour supprimer un utilisateur
    public function delete(): void
    {
        if (!isset($_GET['id'])) {
            die("Erreur : aucun ID spécifié.");
        }

        $userManager = new UserManager();
        $userManager->delete((int)$_GET['id']);

        header("Location: index.php?controller=user&action=list");
        exit;
    }


}
?>
