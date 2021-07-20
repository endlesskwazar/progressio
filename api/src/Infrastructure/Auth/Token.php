<?php

namespace App\Infrastructure\Auth;

use App\Infrastructure\Contracts\Auth\TokenInterface;

final class Token implements TokenInterface
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
