<?php

namespace App\Shared\Infrastructure\Http\Query\Contracts;

interface PaginationQueryInterface
{
    public function getPage(): int;
    public function getPerPage(): int;
    public function setPage(int $page): void;
    public function setPerPage(int $perPage): void;
}
