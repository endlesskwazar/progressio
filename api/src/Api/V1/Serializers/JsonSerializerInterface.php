<?php

namespace App\Api\V1\Serializers;

interface JsonSerializerInterface
{
    public function getClass(): string;

    public function attributes(): array;

    public function ignore(): array;

    public function toJson($obj): string;
}
