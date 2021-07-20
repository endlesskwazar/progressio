<?php

namespace App\Application\Api\Auth\Controllers;

use App\Application\Api\Auth\Requests\RegisterRequest;
use App\Domain\Entity\User;
use App\Infrastructure\Contracts\Auth\AuthServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class AuthController extends AbstractController
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
    public function login(Request $request): JsonResponse
    {
        $token = $this->authService->getToken(
          $request->get('email'),
          $request->get('password')
        );

        return $this->json([
            'token' => $token
        ], 200);
    }
}
