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

    public function getTitle()
    {
        return $this->title;
    }

    public function getPriority()
    {
        return $this->id_priority;
    }

    public function getStatus()
    {
        return $this->id_status;
    }

    public function getId()
    {
        return $this->id_task;
    }
}