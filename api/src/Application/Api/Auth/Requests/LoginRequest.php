<?php

namespace App\Application\Api\Auth\Requests;

use App\Application\Common\ArgumentResolvers\Validation\AbstractValidationRequest;
use Symfony\Component\Validator\Constraints as Assert;

class LoginRequest extends AbstractValidationRequest
{
    protected function constrains(): Assert\Collection
    {
        return new Assert\Collection([
            'email' => new Assert\Email(),
            'password' => new Assert\Optional([
                new Assert\Type("string"),
                new Assert\Length(null, 8, 36)
            ])
        ]);
    }
}
