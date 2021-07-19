<?php

namespace App\Application\Common\ArgumentResolvers\Todo;

use App\Domain\Contracts\Entity\TodoInterface;
use Symfony\Component\HttpFoundation\Request;

interface TodoRequestInterface
{
    public function supports(string $type): bool;

    public function getEntityInstance(Request $request): TodoInterface;

    public function validate(Request $request);
}
