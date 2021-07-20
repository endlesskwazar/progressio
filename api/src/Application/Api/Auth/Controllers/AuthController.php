<?php

namespace App\Application\Api\Auth\Controllers;

use App\Application\Api\Auth\Requests\LoginRequest;
use App\Application\Api\Auth\Requests\RegisterRequest;
use App\Application\Common\BaseController;
use App\Domain\Entity\User;
use App\Infrastructure\Contracts\Auth\AuthServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

final class AuthController extends BaseController
{
    private AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @Route("/api/auth/register", methods={"POST"})
     * @throws ExceptionInterface
     */
    public function register(RegisterRequest $request, SerializerInterface $requestDenormalizer): JsonResponse
    {
        $user = $requestDenormalizer->denormalize(
            $request->getRequest()->request->all(),
            User::class
        );

        $this->authService->register($user);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/api/auth/login", methods={"POST"})
     */
    public function login(
        LoginRequest $request,
        ObjectNormalizer $normalizer
    ): JsonResponse {
        $token = $this->authService->getToken(
            $request->getRequest()->request->get('email'),
            $request->getRequest()->request->get('password')
        );

        return $this->api($token, Response::HTTP_OK, $normalizer);
    }
}
