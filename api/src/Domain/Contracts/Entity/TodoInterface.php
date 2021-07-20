<?php

namespace App\Domain\Contracts\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

interface TodoInterface extends EntityInterface
{
    public const BASE_TYPE = "base";
    public const READ_TYPE = "read";
    public const MEDIA_TYPE = "media";
    public const COURSE_TYPE = "course";

    public static function getType(): string;
    public function setUser(UserInterface $user);
}
