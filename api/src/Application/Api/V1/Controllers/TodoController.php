<?php

namespace App\Application\Api\V1\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends BaseController
{
    /**
     * @Route("/api/v1/todos", methods={"POST"})
     */
    public function create(Request $request)
    {
        $content = $request->request->all();
        dd($content);
    }
}
