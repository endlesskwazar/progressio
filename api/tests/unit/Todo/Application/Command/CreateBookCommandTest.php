<?php

namespace App\Tests\unit\Todo\Application\Command;

use App\Tests\UnitTester;
use App\Todo\Application\Command\CreateBookCommand;
use Codeception\Test\Unit;

class CreateBookCommandTest extends Unit
{
    protected UnitTester $tester;

    public function testTitleValidationFailed(): void
    {
        $validator = $this->tester->grabService('validator');

        $createBookCommand = new CreateBookCommand(
            "Create Book Command test",
            null,
            null,
            null,
            null,
            "q",
            0,
            null,
        );

        $errors = $validator->validate($createBookCommand);
        $this->tester->assertCount(2, $errors);
    }
}
