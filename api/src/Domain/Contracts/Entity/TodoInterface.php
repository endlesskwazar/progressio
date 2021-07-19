<?php

namespace App\Domain\Contracts\Entity;

interface TodoInterface
{
    public const BASE_TYPE = "base";
    public const READ_TYPE = "read";
    public const MEDIA_TYPE = "media";
    public const COURSE_TYPE = "course";

    public static function getType(): string;
}
