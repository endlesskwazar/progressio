<?php

namespace App\Api\V1\Serializers\Todo;

use App\Todo\Domain\Entity\CourseTodo;

class CourseTodoSerializer extends AbstractTodoSerializer
{
    public function getClass(): string
    {
        return CourseTodo::class;
    }
}
