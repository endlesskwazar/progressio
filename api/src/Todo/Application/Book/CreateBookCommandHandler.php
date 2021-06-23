<?php

namespace App\Todo\Application\Book;

use App\Todo\Domain\Contracts\TodoRepositoryInterface;
use App\Todo\Domain\Entity\BookTodo;
use DateTime;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateBookCommandHandler implements MessageHandlerInterface
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(CreateBookCommand $command): BookTodo
    {
        $bookTodo = new BookTodo();
        $bookTodo->setTitle($command->title);

        if ($command->body) {
            $bookTodo->setBody($command->body);
        }

        if ($command->done !== null) {
            $bookTodo->setDone($command->done);
        }

        if ($command->due) {
            $dueDate = DateTime::createFromFormat('Y-m-d H:i:s', $command->due);
            $bookTodo->setDue($dueDate);
        }

        if ($command->pages) {
            $bookTodo->setPages($command->pages);
        }

        if ($command->page) {
            $bookTodo->setPage($command->page);
        }

        if ($command->author) {
            $bookTodo->setAuthor($command->author);
        }

        return $this->todoRepository->create($bookTodo);
    }
}
