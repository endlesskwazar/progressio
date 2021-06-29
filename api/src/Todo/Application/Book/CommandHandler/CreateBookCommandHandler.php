<?php

namespace App\Todo\Application\Book\CommandHandler;

use App\Todo\Application\Book\Command\CreateBookCommand;
use App\Todo\Domain\Contracts\TodoRepositoryInterface;
use App\Todo\Domain\Entity\BookTodo;
use App\Todo\Domain\Entity\Todo;
use App\Todo\Domain\Entity\Url;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\Configuration\Options;
use AutoMapperPlus\MappingOperation\Operation;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;
use Doctrine\Common\Collections\ArrayCollection;
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
        $bookTodo = new BookTodo();
        $bookTodo->setAuthor($command->author);
        $bookTodo->setPage($command->page);
        $bookTodo->setPages($command->pages);
        $bookTodo->setDone($command->done);
        $bookTodo->setTitle($command->title);
        $bookTodo->setBody($command->body);

        if ($command->urls && count($command->urls)) {
            foreach ($command->urls as $url) {
                $bookTodo->addUrl(new Url(
                    $url['src'],
                    $url['description']
                ));
            }
        }

        return $this->todoRepository->create($bookTodo);
    }
}
