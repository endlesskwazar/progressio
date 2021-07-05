<?php

namespace App\Api\V1\Serializers\Todo\Contract;

use App\Todo\Domain\Entity\Todo;

interface TodoSerializerInterface
{
    public function supports(string $class): bool;
    public function serialize(Todo $todo): string;
}
