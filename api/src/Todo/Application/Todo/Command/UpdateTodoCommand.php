<?php

namespace App\Todo\Application\Todo\Command;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateTodoCommand
{
    /**
     * @Assert\NotBlank
     * @Assert\Length(max = 255)
     */
    public string $title;

    /**
     * @Assert\Type(type="integer")
     */
    public int $id;

    public function __construct(int $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }
}
