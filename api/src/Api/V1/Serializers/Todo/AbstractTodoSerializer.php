<?php

namespace App\Api\V1\Serializers\Todo;

use App\Api\V1\Serializers\AbstractJsonSerializer;
use App\Api\V1\Serializers\Todo\Contract\TodoSerializerInterface;
use App\Todo\Domain\Entity\Todo;

abstract class AbstractTodoSerializer extends AbstractJsonSerializer implements TodoSerializerInterface
{
    public function attributes(): array
    {
        return [
            'id',
            'title',
            'created',
            'updated',
            'due',
            'body',
            'done',
        ];
    }

    public function supports(string $class): bool
    {
        return $this->getClass() === $class;
    }

    public function serialize(Todo $todo): string
    {
        return $this->toJson($todo);
    }
}
