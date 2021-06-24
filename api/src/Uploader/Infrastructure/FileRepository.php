<?php

namespace App\Uploader\Infrastructure;

use App\Todo\Domain\Entity\Todo;
use App\Uploader\Domain\Contract\FileRepositoryInterface;
use App\Uploader\Domain\Entity\File;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FileRepository extends ServiceEntityRepository implements FileRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Todo::class);
    }

    public function create(File $file): object
    {
        $em = $this->getEntityManager();

        $em->persist($file);
        $em->flush();

        return $file;
    }
}
