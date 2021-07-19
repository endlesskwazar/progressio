<?php

namespace App\Domain\Contracts\Entity;

interface LearningMaterialProgressInterface
{
    public function getProgress(): ?float;
}
