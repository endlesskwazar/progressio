<?php

namespace App\Application\Factories;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\ClassDiscriminatorFromClassMetadata;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class DeterminatorObjectNormalizer
{
    public function create(): ObjectNormalizer
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $discriminator = new ClassDiscriminatorFromClassMetadata($classMetadataFactory);

        return new ObjectNormalizer($classMetadataFactory, null, null, null, $discriminator);
    }
}