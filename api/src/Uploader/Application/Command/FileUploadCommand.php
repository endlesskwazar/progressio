<?php

namespace App\Uploader\Application\Command;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploadCommand
{
    public UploadedFile $uploadedFile;

    public function __construct(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }
}
