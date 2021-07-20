<?php

namespace App\Application\Common;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

abstract class BaseController extends AbstractController
{
    /**
     * Return api response
     *
     * @param array|object $data Data to return. Will be normalized if object. If array just will be wrapped
     * @param int $code Code to return
     * @param string $wrap Wrap returned data
     * @throws ExceptionInterface
     */
    public function api(
        $data,
        int $code = Response::HTTP_OK,
        ObjectNormalizer $normalizer = null,
        string $wrap = 'data'
    ): JsonResponse
    {
        $res = null;
        $normalized = $data;

        if (is_object($data)) {
            $normalized = $normalizer->normalize($data);
        }

        $res = !empty($wrap) ? [$wrap => $normalized] : $normalized;

        return $this->json($res, $code);
    }
}
