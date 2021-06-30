<?php

namespace App\Todo\Application\Book\CommandHandler;

use App\Todo\Application\Book\Command\CreateBookCommand;
use App\Todo\Domain\Contracts\TodoRepositoryInterface;
use App\Todo\Domain\Entity\BookTodo;
use App\Todo\Domain\Entity\Todo;
use App\Todo\Domain\Entity\Url;
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
        $bookTodo = (new BookTodo())
            ->setAuthor($command->author)
            ->setPages($command->page)
            ->setPages($command->pages)
            ->setDone($command->done)
            ->setTitle($command->title)
            ->setBody($command->body);

        // if command have url data convert it to Url entity and add
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
