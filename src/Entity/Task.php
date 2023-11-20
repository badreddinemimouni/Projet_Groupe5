<?php

namespace Tp\Project\Entity;

class Task {
    private int $id_task;
    private ?int $priority;
    private ?string $title;
    private ?string $description;
    private ?int $id_priority;
    private ?int $id_status;
    private ?int $user_id;
    private ?int $id_project;
}