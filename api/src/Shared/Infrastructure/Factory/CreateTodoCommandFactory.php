<?php

namespace App\Shared\Infrastructure\Factory;

use App\Todo\Application\Book\Command\CreateBookCommand;
use App\Todo\Application\Course\Command\CreateCourseCommand;
use App\Todo\Application\Media\Command\CreateMediaCommand;
use Symfony\Component\HttpFoundation\Request;

class CreateTodoCommandFactory
{
    public static function createCommandFromRequest(Request $request)
    {
        $type = $request->get('type');
        $command = null;

        switch ($type) {
            case 'book':
                $command =  new CreateBookCommand(
                    $request->get('title'),
                    $request->get('body'),
                    $request->get('due'),
                    $request->get('done'),
                    $request->get('pages'),
                    $request->get('page'),
                    $request->get('author'),
                );
                break;
            case 'media':
                $command =  new CreateMediaCommand(
                    $request->get('title'),
                    $request->get('body'),
                    $request->get('due'),
                    $request->get('done'),
                    $request->get('duration'),
                    $request->get('pause'),
                );
                break;
            case 'course':
                $command = new CreateCourseCommand(
                    $request->get('title'),
                    $request->get('body'),
                    $request->get('due'),
                    $request->get('done'),
                    $request->get('steps'),
                    $request->get('step'),
                );
        }

        return $command;
    }
}
