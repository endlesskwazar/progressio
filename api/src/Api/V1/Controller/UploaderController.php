<?php

namespace App\Api\V1\Controller;

use App\Api\V1\Transformer\FileTransformer;
use App\Uploader\Application\Command\FileUploadCommand;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1/files", methods={"POST"})
 */
class UploaderController
{
    protected Manager $manager;
    protected FileTransformer $fileTransformer;

    public function __construct(Manager $manager, FileTransformer $fileTransformer)
    {
        $this->manager = $manager;
        $this->fileTransformer = $fileTransformer;
    }

    public function __invoke(Request $request, MessageBusInterface $commandBus)
    {
        $file = $request->files->get('file');
        $command = new FileUploadCommand($file);

        $envelope = $commandBus->dispatch($command);
        $handledStamp = $envelope->last(HandledStamp::class);
        $commandResult = $handledStamp->getResult();

        $file = new Item($commandResult, $this->fileTransformer, 'file');
        $transformedFile = $this->manager->createData($file);
        return new JsonResponse($transformedFile->toArray());
    }
}
