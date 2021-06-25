<?php

namespace App\User\Application\Command;

class LoginUserCommand
{
    public string $email;
    public string $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
}
