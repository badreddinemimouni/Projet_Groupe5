<?php

namespace Tp\Project\Entity;

class Status {
    private int $id_status;
    private ?string $value;

    public function getStatusValue() {
        return $this->value;
    }
}