<?php

namespace App\Application\Api\V1\Controllers;

use App\Application\Common\BaseController;
use App\Domain\Contracts\Entity\TodoInterface;
use App\Domain\Contracts\Services\TodoServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class TodoController extends BaseController
{
    private TodoServiceInterface $todoService;

    public function __construct(TodoServiceInterface $todoService)
    {
        $this->todoService = $todoService;
    }

    /**
     * @Route("/api/v1/todos", methods={"GET"})
     * @throws ExceptionInterface
     */
    public function findMy(ObjectNormalizer $determinatorObjectNormalizer): JsonResponse
    {
        $todos = $this->todoService->findMy();
        return $this->api($todos, Response::HTTP_OK, $determinatorObjectNormalizer);
    }

    /**
     * @Route("/api/v1/todos", methods={"POST"})
     * @throws ExceptionInterface
     */
    public function create(
        TodoInterface $todo,
        ObjectNormalizer $normalizer
    ): JsonResponse {
        $created = $this->todoService->saveToMe($todo);
        return $this->api($created, Response::HTTP_OK, $normalizer);
    }
}
