<?php

namespace App\Todo\Application\Command;

class RemoveTodoCommand
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
