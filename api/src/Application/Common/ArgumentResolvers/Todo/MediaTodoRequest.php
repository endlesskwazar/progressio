<?php

namespace App\Application\Common\ArgumentResolvers\Todo;

use App\Application\Common\ArgumentResolvers\Validation\AbstractValidationRequest;
use App\Domain\Contracts\Entity\TodoInterface;
use App\Domain\Entity\BaseTodo;
use App\Domain\Entity\MediaTodo;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MediaTodoRequest extends AbstractValidationRequest implements TodoRequestInterface
{
    private SerializerInterface $serializer;

    public function __construct(
        ValidatorInterface $validator,
        RequestStack $requestStack,
        SerializerInterface $serializer
    ) {
        parent::__construct($validator, $requestStack->getCurrentRequest());
        $this->serializer = $serializer;
    }

    public function supports(string $type): bool
    {
        return TodoInterface::MEDIA_TYPE === $type;
    }

    protected function constrains(): Assert\Collection
    {
        return new Assert\Collection([
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
            'pause' => new Assert\Optional([
                new Assert\Type("string"),
            ]),
            'duration' => new Assert\Optional([
                new Assert\Type("string"),
            ]),
        ]);
    }

    /**
     * @throws ExceptionInterface
     */
    public function getEntityInstance(): MediaTodo
    {
        return $this->serializer->denormalize(
            $this->getRequest()->request->all(),
            MediaTodo::class
        );
    }
}
