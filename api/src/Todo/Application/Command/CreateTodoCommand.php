<?php

namespace App\Todo\Application\Command;

/**
 * Create new project.
 *
 * @property string $name Todo name
 */
class CreateTodoCommand
{
    /**
     * @Constraints\NotBlank()
     * @Constraints\Length(max = "255")
     */
    public string $title;
}
