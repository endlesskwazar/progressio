<?php

namespace App\Application\Common\ArgumentResolvers\Validation;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationListInterface;

interface ValidationRequestInterface
{
    public function validate(): ConstraintViolationListInterface;
    public function getRequest(): Request;
}