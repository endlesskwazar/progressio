<?php

namespace App\Todo\Application\Command;

use Symfony\Component\Validator\Constraints as Assert;

class CreateTodoCommand
{
    /**
     * @Assert\NotBlank
     * @Assert\Length(max = 255)
     */
    public string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }
}
