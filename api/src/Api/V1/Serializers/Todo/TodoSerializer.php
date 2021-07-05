<?php

namespace App\Api\V1\Serializers\Todo;

use App\Api\V1\Serializers\Todo\Contract\TodoSerializerInterface;
use App\Todo\Domain\Entity\Todo;

class TodoSerializer
{
    /**
     * @var $todoSerializers TodoSerializerInterface[]
     */
    private array $todoSerializers = [];

    public function addTodoSerializer(TodoSerializerInterface $todoSerializer): void
    {
        $this->todoSerializers[] = $todoSerializer;
    }

    /**
     * @throws TodoSerializationNotSupported
     */
    public function toJson(Todo $todo): string
    {
        foreach ($this->todoSerializers as $todoSerializer) {
            if ($todoSerializer->supports(get_class($todo))) {
                return $todoSerializer->serialize($todo);
            }

            throw new TodoSerializationNotSupported();
        }
    }
}
