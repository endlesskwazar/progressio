<?php

namespace App\Api\V1\Controller;

use App\User\Application\Command\RegisterUserCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    /**
     * @Route  ("/api/v1/users/register", methods={"POST"})
     */
    public function create(Request $request, MessageBusInterface $commandBus)
    {
        $command = new RegisterUserCommand(
            $request->get('email'),
            $request->get('name'),
            $request->get('password')
        );

        $envelope = $commandBus->dispatch($command);
        $handledStamp = $envelope->last(HandledStamp::class);
        $commandResult = $handledStamp->getResult();

        return (new JsonResponse())->setStatusCode(204);
    }
}
