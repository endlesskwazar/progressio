<?php

namespace App\Infrastructure\Contracts\Auth;

/**
 * Holds token data
 *
 * Interface TokenInterface
 * @package App\Infrastructure\Contracts\Auth
 */
interface TokenInterface
{
    /**
     * Get token in string format
     *
     * @return string
     */
    public function getToken(): string;
}
