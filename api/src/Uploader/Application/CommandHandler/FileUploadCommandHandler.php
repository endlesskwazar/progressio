<?php

namespace App\Uploader\Application\CommandHandler;

use App\Uploader\Application\Command\FileUploadCommand;
use App\Uploader\Domain\Contract\FileRepositoryInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploadCommandHandler implements MessageHandlerInterface
{
    private FileRepositoryInterface $fileRepository;
    private SluggerInterface $slugger;
    private ContainerInterface $container;

    public function __construct(
        FileRepositoryInterface $fileRepository,
        SluggerInterface $slugger,
        ContainerInterface $container
    ) {
        $this->fileRepository = $fileRepository;
        $this->slugger = $slugger;
        $this->container = $container;
    }

    public function __invoke(FileUploadCommand $command)
    {
        $uploadedFile = $command->uploadedFile;

        $fileSlug = $this->slugger->slug($uploadedFile->getClientOriginalName());

        $uploadedFile->move(
            $this->container->getParameter('public_upload_dir'),
            uniqid('', true) . $fileSlug
        );
    }
}
