<?php

namespace App\Application\Api\V1\Controllers;

use App\Domain\Contracts\Entity\TodoInterface;
use App\Domain\Contracts\Services\TodoServiceInterface;
use App\Domain\Entity\BaseTodo;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class TodoController extends AbstractController
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

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $serializer = new Serializer([$normalizer]);

        $created = $this->todoService->saveToMe($todo);
        $json = $serializer->serialize($created, 'json');
        return $this->json($json, JsonResponse::HTTP_CREATED);
    }
}
