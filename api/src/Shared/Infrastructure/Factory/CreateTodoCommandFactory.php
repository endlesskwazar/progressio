<?php

namespace App\Shared\Infrastructure\Factory;

use App\Todo\Application\Book\CreateBookCommand;
use App\Todo\Application\Course\CreateCourseCommand;
use App\Todo\Application\Media\CreateMediaCommand;
use Symfony\Component\HttpFoundation\Request;

class CreateTodoCommandFactory
{
    public static function createCommand(Request $request)
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
