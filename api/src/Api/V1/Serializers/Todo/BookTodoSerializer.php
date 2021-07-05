<?php

namespace App\Api\V1\Serializers\Todo;

use App\Todo\Domain\Entity\BookTodo;

class BookTodoSerializer extends AbstractTodoSerializer
{
    public function getClass(): string
    {
        return BookTodo::class;
    }
}
