<?php

namespace App\Application\Api\Auth\Requests;

use App\Application\Common\ArgumentResolvers\Validation\AbstractValidationRequest;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterRequest extends AbstractValidationRequest
{
    protected function constrains(): Assert\Collection
    {
        return new Assert\Collection([
            'email' => new Assert\Email(),
            'name' => [
                new Assert\NotBlank(),
                new Assert\Type("string"),
            ],
            'password' => new Assert\Optional([
                new Assert\Type("string"),
                new Assert\Length(null, 8, 36)
            ])
        ]);
    }
}