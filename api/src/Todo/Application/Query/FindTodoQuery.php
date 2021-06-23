<?php

namespace App\Todo\Application\Query;

class FindTodoQuery
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
