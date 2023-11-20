<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires
use Tp\Project\App\Model;
use Tp\Project\Entity\Task;

class TaskController {
    
    public function changeStatus($status) {
        // Méthode pour changer le statut de la tâche
        $this->status = $status;
    }

    // Méthode pour ajouter une tâche à un projet
    public function addTask($projectId, $userId, $title, $description, $priority, $status)
    {
        $stmt = $this->conn->prepare("INSERT INTO tasks (project_id, user_id, title, description, priority, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$projectId, $userId, $title, $description, $priority, $status]);
        // Autres opérations après l'insertion, si nécessaire
    }

    // Méthode pour mettre à jour l'état d'une tâche
    public function updateTaskStatus($taskId, $newStatus)
    {
        $stmt = $this->conn->prepare("UPDATE tasks SET status = ? WHERE id = ?");
        $stmt->execute([$newStatus, $taskId]);
        // Autres opérations après la mise à jour, si nécessaire
    }

    // Méthode pour supprimer une tâche
    public function deleteTask($taskId)
    {
        $stmt = $this->conn->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->execute([$taskId]);
        // Autres opérations après la suppression, si nécessaire
    }
    
    // Méthode pour récupérer toutes les tâches associées à un projet
    public function getTasksByProject($projectId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tasks WHERE project_id = ?");
        $stmt->execute([$projectId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

