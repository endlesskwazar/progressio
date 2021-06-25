<?php

namespace App\Api\V1\Transformer;

use App\Uploader\Domain\Entity\File;
use League\Fractal\TransformerAbstract;

class FileTransformer extends TransformerAbstract
{
    public function transform(File $file): array
    {
        return [
            'id' => $file->getId(),
            'kind' => $file->getKind(),
            'mime' => $file->getMime(),
            'originalFileName' => $file->getOriginalName(),
            'src' => $file->getSrc()
        ];
    }
}
