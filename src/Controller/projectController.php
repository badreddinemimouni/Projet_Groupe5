<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires
use Tp\Project\App\Model;
use Tp\Project\Entity\Project;

class ProjectController {

    // Ajouter un utilisateur au projet s'il n'est pas déjà membre
    public function addUser(User $user) {
        if (!in_array($user, $this->users, true)) {
            $this->users[] = $user;
        }
    }

    // Ajouter une tâche au projet
    public function addTask(Task $task) {
        $this->tasks[] = $task;
    }

    // Méthode pour créer un nouveau projet avec un administrateur
    public function createProject($adminUserId, $projectTitle)
    {
        $stmt = $this->conn->prepare("INSERT INTO projects (admin_user_id, title) VALUES (?, ?)");
        $stmt->execute([$adminUserId, $projectTitle]);
        // Autres opérations après la création du projet, si nécessaire
    }

    // Méthode pour mettre à jour les détails d'un projet
    public function updateProject($projectId, $newTitle)
    {
        $stmt = $this->conn->prepare("UPDATE projects SET title = ? WHERE id = ?");
        $stmt->execute([$newTitle, $projectId]);
        // Autres opérations après la mise à jour du projet, si nécessaire
    }

    // Méthode pour supprimer un projet et ses données associées
    public function deleteProject($projectId)
    {
        // Supprimer les tâches associées au projet (cette logique peut varier en fonction de vos besoins)
        $stmtTasks = $this->conn->prepare("DELETE FROM tasks WHERE project_id = ?");
        $stmtTasks->execute([$projectId]);

        // Supprimer le projet lui-même
        $stmtProjects = $this->conn->prepare("DELETE FROM projects WHERE id = ?");
        $stmtProjects->execute([$projectId]);

        // Autres opérations après la suppression du projet, si nécessaire
    }

    // Méthode pour gérer les utilisateurs associés à un projet (ajout ou suppression d'utilisateur)
    public function manageProjectUsers($projectId, $userId, $action)
    {
        // Ajouter un utilisateur au projet
        if ($action === 'add') {
            $stmt = $this->conn->prepare("INSERT INTO project_users (project_id, user_id) VALUES (?, ?)");
            $stmt->execute([$projectId, $userId]);
            // Supprimer un utilisateur du projet
        } elseif ($action === 'remove') {
            $stmt = $this->conn->prepare("DELETE FROM project_users WHERE project_id = ? AND user_id = ?");
            $stmt->execute([$projectId, $userId]);
        }
        // Autres opérations après la gestion des utilisateurs, si nécessaire
    }
}