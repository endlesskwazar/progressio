<?php

namespace App\Uploader\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="files")
 * @ORM\HasLifecycleCallbacks
 */
class File
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private string $originalFileName;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private string $src;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private string $kind;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private string $mime;
}
