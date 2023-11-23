<?php

namespace Tp\Project\Entity;

class Task
{
    private int $id_task;
    private ?int $priority;
    private ?string $title;
    private ?string $description;
    private ?int $id_priority;
    private ?int $id_status;
    private ?int $user_id;
    private ?int $project_id;

    // Méthode pour récupérer l'identifiant de la tâche
    public function getId()
    {
        return $this->id_task;
    }

    // Méthode pour récupérer le projet de la tâche
    public function getProjectId()
    {
        return $this->project_id;
    }
    
    // Méthode pour récupérer la priorité de la tâche
    public function getPriority()
    {
        return $this->id_priority;
    }

    // Méthode pour récupérer le titre de la tâche
    public function getTitle()
    {
        return $this->title;
    }

    // Méthode pour récupérer la description de la tâche
    public function getDescription()
    {
        return $this->description;
    }

    // Méthode pour récupérer le statut de la tâche
    public function getStatus()
    {
        return $this->id_status;
    }

    // Méthode pour récupérer l'identifiant de l'utilisateur de la tâche
    public function getUserId()
    {
        return $this->user_id;
    }
}