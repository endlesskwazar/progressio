<?php

namespace App\Api\V1\Transformer;

use App\Todo\Domain\Entity\Todo;

class CourseTodoTransformer extends BaseTodoTransformer
{
    public function transform(Todo $todo): array
    {
        return array_merge(
            parent::transform($todo),
            [
                'steps' => $todo->getSteps(),
                'step' => $todo->getStep()
            ]
        );
    }
}
