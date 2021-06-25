<?php

namespace App\Todo\Application\Media\CommandHandler;

use App\Todo\Application\Media\Command\CreateMediaCommand;
use App\Todo\Domain\Contracts\TodoRepositoryInterface;
use App\Todo\Domain\Entity\MediaTodo;
use App\Todo\Domain\Entity\Todo;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\Configuration\Options;
use AutoMapperPlus\MappingOperation\Operation;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateMediaCommandHandler implements MessageHandlerInterface
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(CreateMediaCommand $command): Todo
    {
        $config = new AutoMapperConfig();
        $config->registerMapping(CreateMediaCommand::class, MediaTodo::class)
            ->forMember('id', Operation::ignore())
            ->setDefaults(function (Options $options) {
                $options->ignoreNullProperties();
            })
            ->withNamingConventions(
                new CamelCaseNamingConvention(),
                new SnakeCaseNamingConvention()
            );

        $mapper = new AutoMapper($config);
        $todo = $mapper->map($command, MediaTodo::class);

        return $this->todoRepository->create($todo);
    }
}
