<?php

namespace App\Application\Api\V1\Controllers;

use App\Application\Common\BaseController;
use App\Domain\Contracts\Entity\TodoInterface;
use App\Domain\Contracts\Services\TodoServiceInterface;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Mapping\ClassDiscriminatorFromClassMetadata;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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
    public function findMy(): JsonResponse
    {
        $todos = $this->todoService->findMy();

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $discriminator = new ClassDiscriminatorFromClassMetadata($classMetadataFactory);

        $serializer = new Serializer(
            [new ObjectNormalizer($classMetadataFactory, null, null, null, $discriminator)],
            ['json' => new JsonEncoder()]
        );

        return JsonResponse::fromJsonString($serializer->serialize($todos, 'json'));
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
