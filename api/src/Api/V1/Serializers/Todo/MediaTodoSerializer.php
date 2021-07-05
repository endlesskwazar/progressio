<?php

namespace App\Api\V1\Serializers\Todo;

use App\Todo\Domain\Entity\MediaTodo;

class MediaTodoSerializer extends AbstractTodoSerializer
{
    public function getClass(): string
    {
        return MediaTodo::class;
    }
}
