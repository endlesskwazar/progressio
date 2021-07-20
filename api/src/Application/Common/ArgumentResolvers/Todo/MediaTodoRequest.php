<?php

namespace App\Application\Common\ArgumentResolvers\Todo;

use App\Application\Common\ArgumentResolvers\Validation\AbstractValidationRequest;
use App\Domain\Entity\MediaTodo;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MediaTodoRequest extends AbstractValidationRequest implements TodoRequestInterface
{
    public function __construct(ValidatorInterface $validator, RequestStack $requestStack)
    {
        parent::__construct($validator, $requestStack->getCurrentRequest());
    }

    public function supports(string $type): bool
    {
        return MediaTodo::getType() === $type;
    }

    /**
     * @throws ExceptionInterface
     */
    public function getEntityInstance(): MediaTodo
    {
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
        ]);
    }
}
