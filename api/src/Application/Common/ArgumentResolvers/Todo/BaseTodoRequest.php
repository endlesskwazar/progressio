<?php

namespace App\Application\Common\ArgumentResolvers\Todo;

use App\Domain\Entity\BaseTodo;
use Doctrine\Common\Annotations\AnnotationReader;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

class BaseTodoRequest implements TodoRequestInterface
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
        return BaseTodo::getType() === $type;
    }

    /**
     * @throws Exception
     * @throws ExceptionInterface
     */
    public function getEntityInstance(Request $request): BaseTodo
    {
        $this->validate($request);

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $serializer = new Serializer([$normalizer]);

        return $serializer->denormalize(
            $request->request->all(),
            BaseTodo::class,
        );
    }

    /**
     * @throws Exception
     */
    public function validate(Request $request)
    {
        $constraint = new Assert\Collection([
            'type' => new Assert\EqualTo("base"),
            'title' => [
                new Assert\NotBlank(),
                new Assert\Type("string"),
                new Assert\Length(null, null, 200)
            ],
            'description' => new Assert\Optional([
                new Assert\Type("string"),
                new Assert\Length(null, null, 1600)
            ])
        ]);

        $violations = $this->validator->validate($request->request->all(), $constraint);

        if (0 !== count($violations)) {
            throw new Exception("Violations");
        }
    }
}
