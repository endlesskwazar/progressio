<?php

namespace App\Api\V1\Serializers;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractJsonSerializer implements JsonSerializerInterface
{
    protected SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function attributes(): array
    {
        return [];
    }

    public function ignore(): array
    {
        return [];
    }

    public function toJson($obj): string
    {
        return $this->serializer->serialize($obj, 'json', [
            AbstractNormalizer::ATTRIBUTES => $this->attributes(),
            AbstractNormalizer::IGNORED_ATTRIBUTES => $this->ignore(),
        ]);
    }
}
