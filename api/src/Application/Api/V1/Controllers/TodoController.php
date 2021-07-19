<?php

namespace App\Application\Api\V1\Controllers;

use App\Domain\Contracts\Entity\TodoInterface;
use App\Domain\Contracts\Services\TodoServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TodoController extends BaseController
{
    private TodoServiceInterface $todoService;

    public function __construct(TodoServiceInterface $todoService)
    {
        $this->todoService = $todoService;
    }

    /**
     * @Route("/api/v1/todos", methods={"POST"})
     */
    public function create(
        TodoInterface $todo,
        SerializerInterface $serializer
    ): JsonResponse {
        $created = $this->todoService->save($todo);
        $json = $serializer->serialize($created, 'json');
        return $this->json($json, JsonResponse::HTTP_CREATED);
    }
}
