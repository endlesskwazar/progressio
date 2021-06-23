<?php

namespace App\Api\V1\Transformer;

use App\Todo\Domain\Entity\BookTodo;
use App\Todo\Domain\Entity\CourseTodo;
use App\Todo\Domain\Entity\MediaTodo;
use App\Todo\Domain\Entity\Todo;
use League\Fractal\TransformerAbstract;

class TodoTransformer extends TransformerAbstract
{
    public function transform(Todo $todo): array
    {
        $transformer = null;

        switch (get_class($todo)) {
            case MediaTodo::class:
                $transformer = new MediaTodoTransformer();
                break;
            case BookTodo::class:
                $transformer = new BookTodoTransformer();
                break;
            case CourseTodo::class:
                $transformer = new CourseTodoTransformer();
        }
        return $transformer->transform($todo);
    }
}
