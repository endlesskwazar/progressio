<?php

namespace App\Todo\Application\Course\CommandHandler;

use App\Todo\Application\Course\Command\CreateCourseCommand;
use App\Todo\Domain\Contracts\TodoRepositoryInterface;
use App\Todo\Domain\Entity\CourseTodo;
use App\Todo\Domain\Entity\Todo;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\Configuration\Options;
use AutoMapperPlus\MappingOperation\Operation;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateCourseCommandHandler implements MessageHandlerInterface
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(CreateCourseCommand $command): Todo
    {
        $config = new AutoMapperConfig();
        $config->registerMapping(CreateCourseCommand::class, CourseTodo::class)
            ->forMember('id', Operation::ignore())
            ->setDefaults(function (Options $options) {
                $options->ignoreNullProperties();
            })
            ->withNamingConventions(
                new CamelCaseNamingConvention(),
                new SnakeCaseNamingConvention()
            );

        $mapper = new AutoMapper($config);
        $todo = $mapper->map($command, CourseTodo::class);

        return $this->todoRepository->create($todo);
    }
}
