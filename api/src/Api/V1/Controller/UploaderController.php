<?php

namespace App\Api\V1\Controller;

use App\Uploader\Application\Command\FileUploadCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1/files", methods={"POST"})
 */
class UploaderController
{
    public function __invoke(Request $request, MessageBusInterface $commandBus)
    {
        $name = "qwe";
        $file = $request->files->get('file');
        $command = new FileUploadCommand($file);

        $envelope = $commandBus->dispatch($command);
        $handledStamp = $envelope->last(HandledStamp::class);
        $todos = $handledStamp->getResult();

        return new Response(sprintf('Hello %s!', $name));
    }
}
