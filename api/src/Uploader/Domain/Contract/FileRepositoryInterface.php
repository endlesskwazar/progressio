<?php

namespace App\Uploader\Domain\Contract;

use App\Uploader\Domain\Entity\File;

interface FileRepositoryInterface
{
    public function create(File $file): object;
}
