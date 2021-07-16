<?php

use App\Domain\Entity\ReadTodo;
use App\Tests\UnitTester;

class ReadTodoCest
{
    public function _before(UnitTester $I)
    {
    }

    public function itShouldReturnNullProgress(UnitTester $I): void
    {
        $readTodo = new ReadTodo(
            "Sample",
            null,
            null,
            null,
            null,
            null,
            null,
        );

        $I->assertNull($readTodo->getProgress());
    }

    public function itShouldCalculateProgress(UnitTester $I): void
    {
        $readTodo = new ReadTodo(
            "Sample",
            null,
            null,
            null,
            null,
            500,
            500,
        );

        $I->assertEquals(100, $readTodo->getProgress());

        $readTodo->setPages(100);
        $readTodo->setPage(90);

        $I->assertEquals(90, $readTodo->getProgress());

        $readTodo->setPages(500);
        $readTodo->setPage(43);

        $I->assertEquals(8.60, $readTodo->getProgress());
    }
}
