<?php

namespace App\Api\V1\Controller;

use App\Todo\Application\Todo\Query\ListTodosQuery;
use App\User\Application\Command\LoginUserCommand;
use App\User\Application\Command\RegisterUserCommand;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\DataType;
use AutoMapperPlus\MappingOperation\Operation;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    /**
     * @Route  ("/api/v1/auth/register", methods={"POST"})
     */
    public function register(Request $request, MessageBusInterface $commandBus): JsonResponse
    {
        $config = new AutoMapperConfig();
        $config->registerMapping(DataType::ARRAY, RegisterUserCommand::class)
            ->forMember('id', Operation::ignore())
            ->withNamingConventions(
                new CamelCaseNamingConvention(),
                new SnakeCaseNamingConvention()
            );
        $mapper = new AutoMapper($config);

        $command =  $mapper->map($request->request->all(), RegisterUserCommand::class);
        $commandBus->dispatch($command);

        return $this->json(null, 204);
    }

    /**
     * @Route  ("/api/v1/auth/login", methods={"POST"})
     */
    public function login(Request $request, MessageBusInterface $commandBus): JsonResponse
    {
        $command = new LoginUserCommand($request->get('email'), $request->get('password'));

        $envelope = $commandBus->dispatch($command);
        $handledStamp = $envelope->last(HandledStamp::class);
        $jwt = $handledStamp->getResult();

        dd($jwt);
    }
}
