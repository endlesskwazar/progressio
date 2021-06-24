<?php

namespace App\Todo\Application\Todo\Command;

class RemoveTodoCommand
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
