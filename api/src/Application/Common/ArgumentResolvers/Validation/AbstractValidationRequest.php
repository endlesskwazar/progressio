<?php

namespace App\Application\Common\ArgumentResolvers\Validation;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractValidationRequest implements ValidationRequestInterface
{
    private ValidatorInterface $validator;
    private Request $request;

    public function __construct(ValidatorInterface $validator, Request $request)
    {
        $this->validator = $validator;
        $this->request = $request;
    }

    abstract protected function constrains(): Assert\Collection;

    public function validate(): ConstraintViolationListInterface
    {
        return $this->validator->validate(
            $this->request->request->all(),
            $this->constrains()
        );
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}