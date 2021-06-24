<?php

namespace App\Api\V1\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1/files", methods={"POST"})
 */
class UploaderController
{
    public function __invoke(Request $request)
    {
        $name = "qwe";
        $file = $request->files->get('file');
        dd($file->guessExtension());
        return new Response(sprintf('Hello %s!', $name));
    }
}
