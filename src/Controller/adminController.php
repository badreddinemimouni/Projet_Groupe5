<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires
use Tp\Project\App\Model;
use Tp\Project\Entity\Admin;

class AdminController {

    // Créer un nouvel utilisateur et l'ajouter au projet
    public function createUser(Project $project, $username) {
        $newUser = new User(/* Générez l'ID d'utilisateur de manière appropriée */ $username);
        $project->addUser($newUser);
        return $newUser;
    }

    // Affecter un utilisateur existant au projet administré
    public function assignUserToProject(User $user, Project $project) {
        $project->addUser($user);
    }

    // D'autres fonctionnalités spécifiques à l'administrateur peuvent être ajoutées ici
}

