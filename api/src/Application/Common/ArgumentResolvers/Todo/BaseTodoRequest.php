<?php

namespace App\Application\Common\ArgumentResolvers\Todo;

use App\Application\Common\ArgumentResolvers\Validation\AbstractValidationRequest;
use App\Domain\Contracts\Entity\TodoInterface;
use App\Domain\Entity\BaseTodo;
use Doctrine\Common\Annotations\AnnotationReader;
use Exception;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BaseTodoRequest extends AbstractValidationRequest implements TodoRequestInterface
{
    private SerializerInterface $serializer;

    public function __construct(
        ValidatorInterface $validator,
        RequestStack $requestStack,
        SerializerInterface $serializer
    ) {
        $this->serializer = $serializer;
        parent::__construct($validator, $requestStack->getCurrentRequest());
    }

    public function supports(string $type): bool
    {
        return BaseTodo::getType() === $type;
    }

    protected function constrains(): Assert\Collection
    {
        return new Assert\Collection([
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
    }

    /**
     * @throws Exception
     * @throws ExceptionInterface
     */
    public function getEntityInstance(): TodoInterface
    {
        $violations = $this->validate();

        if (0 !== count($violations)) {
            throw new Exception("Violations");
        }

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $serializer = new Serializer([$normalizer]);


        return $serializer->denormalize(
            $this->getRequest()->request->all(),
            BaseTodo::class
        );
    }
}
