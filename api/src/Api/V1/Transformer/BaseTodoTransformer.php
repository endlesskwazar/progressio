<?php

namespace App\Api\V1\Transformer;

use App\Todo\Domain\Entity\Todo;
use League\Fractal\TransformerAbstract;

class BaseTodoTransformer extends TransformerAbstract
{
    public function transform(Todo $todo): array
    {
        return [
            'id' => $todo->getId(),
            'title' => $todo->getTitle(),
            'done' => $todo->getDone(),
            'body' => $todo->getBody(),
            'due' => $todo->getDue(),
            'created' => $todo->getCreated(),
            'updated' => $todo->getUpdated()
        ];
    }
}
