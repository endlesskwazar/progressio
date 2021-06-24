<?php

namespace App\Shared\Infrastructure\Http\Query\Contracts;

interface SortingQueryInterface
{
    public function getSortField(): string;
    public function getSortDirection(): string;
    public function setSortField(string $sortField): void;
    public function setSortDirection(string $sortDirection): void;
}
