<?php

namespace App\Todo\Application\Book\CommandHandler;

use App\Todo\Application\Book\Command\CreateBookCommand;
use App\Todo\Domain\Contracts\TodoRepositoryInterface;
use App\Todo\Domain\Entity\BookTodo;
use App\Todo\Domain\Entity\Todo;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\Configuration\Options;
use AutoMapperPlus\MappingOperation\Operation;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateBookCommandHandler implements MessageHandlerInterface
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(CreateBookCommand $command): Todo
    {
        $config = new AutoMapperConfig();
        $config->registerMapping(CreateBookCommand::class, BookTodo::class)
            ->forMember('id', Operation::ignore())
            ->setDefaults(function (Options $options) {
                $options->ignoreNullProperties();
            })
            ->withNamingConventions(
                new CamelCaseNamingConvention(),
                new SnakeCaseNamingConvention()
            );

        $mapper = new AutoMapper($config);
        $bookTodo = $mapper->map($command, BookTodo::class);

        return $this->todoRepository->create($bookTodo);
    }
}
