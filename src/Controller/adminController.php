<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires
use Tp\Project\App\Model;
use Tp\Project\App\AbstractController;
use Tp\Project\Forms\AdminForm;

class AdminController {

    // Créer un nouvel utilisateur et l'ajouter au projet
    public function createMember(Project $project, $username) {
        $newMember = new User(/* Générez l'ID d'utilisateur de manière appropriée */ $username);
        $project->addUser($newMember);
        return $newMember;
    }
 
    // Affecter un utilisateur existant au projet administré
    public function assignMemberToProject(User $member, Project $project) {
        $project->addUser($member);
    }

    // D'autres fonctionnalités spécifiques à l'administrateur peuvent être ajoutées ici
}