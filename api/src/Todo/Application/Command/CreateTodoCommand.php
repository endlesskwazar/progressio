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

    /**
     * @Assert\Type("string")
     * @Assert\Length(max = 8000)
     */
    public ?string $body;

    /**
     * @Assert\Type("string")
     * @Assert\Length(max = 100)
     */
    public ?string $due;

    /**
     * @Assert\Type("bool")
     */
    public ?bool $done;

    public function __construct(string $title, ?string $body, ?string $due, ?bool $done)
    {
        $this->title = $title;
        $this->body = $body;
        $this->done = $done;
        $this->due = $due;
    }
}
