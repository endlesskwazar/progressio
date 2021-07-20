<?php

namespace App\Application\Common\ArgumentResolvers\Todo;

use App\Domain\Contracts\Entity\TodoInterface;
use Exception;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class TodoArgumentResolver implements ArgumentValueResolverInterface
{
    protected TodoRequest $todoRequest;

    public function __construct(TodoRequest $todoRequest)
    {
        $this->todoRequest = $todoRequest;
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return TodoInterface::class === $argument->getType();
    }

    /**
     * @throws Exception
     */
    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        // Todo get rid of elvise
        yield $this->todoRequest->getEntityInstanceIfValid($request->get("type") ?? "", $request);
    }
}
