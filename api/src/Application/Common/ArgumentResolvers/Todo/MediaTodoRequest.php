<?php

namespace App\Application\Common\ArgumentResolvers\Todo;

use App\Domain\Entity\MediaTodo;
use Doctrine\Common\Annotations\AnnotationReader;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MediaTodoRequest implements TodoRequestInterface
{
    private ValidatorInterface $validator;
    private SerializerInterface $serializer;

    public function __construct(ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $this->validator = $validator;
        $this->serializer = $serializer;
    }

    public function supports(string $type): bool
    {
        return MediaTodo::getType() === $type;
    }

    /**
     * @throws ExceptionInterface
     */
    public function getEntityInstance(Request $request): MediaTodo
    {
        $this->validate($request);

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $serializer = new Serializer([$normalizer]);

        return $serializer->denormalize(
            $request->request->all(),
            MediaTodo::class,
        );
    }

    public function validate(Request $request)
    {
        $constraint = new Assert\Collection([
            'type' => new Assert\EqualTo("media"),
            'title' => [
                new Assert\NotBlank(),
                new Assert\Type("string"),
                new Assert\Length(null, null, 200)
            ],
            'description' => new Assert\Optional([
                new Assert\Type("string"),
                new Assert\Length(null, null, 1600)
            ]),
            'review' => new Assert\Optional([
                new Assert\Type("string"),
                new Assert\Length(null, null, 2000)
            ]),
            'rating' => new Assert\Optional([
                new Assert\Type("integer"),
                new Assert\Range([
                    'min' => 1,
                    'max' => 5
                ]),
            ]),
        ]);

        $violations = $this->validator->validate($request->request->all(), $constraint);

        if (0 !== count($violations)) {
            throw new Exception("Violations");
        }
    }
}
