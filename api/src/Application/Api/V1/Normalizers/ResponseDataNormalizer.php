<?php

namespace App\Application\Api\V1\Normalizers;

use App\Domain\Contracts\Entity\EntityInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ResponseDataNormalizer implements NormalizerInterface
{
    private ObjectNormalizer $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        $normalizer_entity = $this->normalizer->normalize($object, $format, $context);

        return [
            'data' => $normalizer_entity
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof EntityInterface;
    }
}
