<?php

namespace Tp\Project\Entity;

class Priority
{
    private int $id_priority;
    private ?string $value;

    public function getPriorityValue() {
        return $this->value;
    }
}