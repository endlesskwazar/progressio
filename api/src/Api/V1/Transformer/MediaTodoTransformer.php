<?php

namespace App\Api\V1\Transformer;

use App\Todo\Domain\Entity\Todo;

class MediaTodoTransformer extends BaseTodoTransformer
{
    public function transform(Todo $todo): array
    {
        return array_merge(
            parent::transform($todo),
            [
                'duration' => $todo->getDuration(),
                'pause' => $todo->getPause()
            ]
        );
    }
}