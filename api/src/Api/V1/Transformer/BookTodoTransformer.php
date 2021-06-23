<?php

namespace App\Api\V1\Transformer;

use App\Todo\Domain\Entity\Todo;

class BookTodoTransformer extends BaseTodoTransformer
{
    public function transform(Todo $todo): array
    {
        return array_merge(
            parent::transform($todo),
            [
                'pages' => $todo->getPages(),
                'page' => $todo->getPage(),
                'author' => $todo->getAuthor()
            ]
        );
    }
}
