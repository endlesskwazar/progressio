<?php

namespace App\Shared\Infrastructure\Http\Query;

use App\Shared\Infrastructure\Http\Query\Contracts\PaginationQueryInterface;

class PaginationQuery implements PaginationQueryInterface
{

    public function getPage(): int
    {
        // TODO: Implement getPage() method.
    }

    public function getPerPage(): int
    {
        // TODO: Implement getPerPage() method.
    }

    public function setPage(int $page): void
    {
        // TODO: Implement setPage() method.
    }

    public function setPerPage(int $perPage): void
    {
        // TODO: Implement setPerPage() method.
    }
}
