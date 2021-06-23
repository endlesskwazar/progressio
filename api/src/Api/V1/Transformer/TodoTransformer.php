<?php

namespace App\Api\V1\Transformer;

use App\Todo\Domain\Entity\Todo;
use League\Fractal\TransformerAbstract;

class TodoTransformer extends TransformerAbstract
{
    public function transform(Todo $todo): array
    {
        return [
            'id'      => $todo->getId(),
            'title'   => $todo->getTitle(),
        ];
    }
}
