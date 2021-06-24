<?php

namespace App\Uploader\Application\CommandHandler;

use App\Uploader\Application\Command\FileUploadCommand;
use App\Uploader\Domain\Contract\FileRepositoryInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploadCommandHnadler implements MessageHandlerInterface
{
    private FileRepositoryInterface $fileRepository;
    private SluggerInterface $slugger;
    private Container $container;

    public function __construct(
        FileRepositoryInterface $fileRepository,
        SluggerInterface $slugger
    ) {
        $this->fileRepository = $fileRepository;
        $this->slugger = $slugger;
    }

    public function __invoke(FileUploadCommand $command)
    {
//        $uploadedFile = $command->uploadedFile;
//        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
//        // this is needed to safely include the file name as part of the URL
//        $safeFilename = $this->slugger->slug($originalFilename);
//        $newFilename = $safeFilename . '-' . uniqid('', true) . '.' . $uploadedFile->guessExtension();
//
//
//        $uploadedFile->move(
//            $this->container->getParameter('brochures_directory'),
//            $newFilename
//        );
    }
}
