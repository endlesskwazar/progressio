<?php

namespace App\Application\Common\ArgumentResolvers\Todo;

use App\Domain\Contracts\Entity\TodoInterface;

interface TodoRequestInterface
{
    public function supports(string $type): bool;

    public function getEntityInstance(): TodoInterface;
}
