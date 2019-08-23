<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MediaController extends AbstractController
{
    /**
     * @Route("/api/media/upload", name="api_media_upload", methods={"POST"})
     */
    public function uploadAction(Request $request): JsonResponse
    {
        $success = false;
        $errors = [];
        $message = 'Post creation failed. Please try again.';

        $data = [
            'success' => $success,
            'message' => $message,
            'errors' => $errors
        ];

        $response = new JsonResponse();
        $response->setData([
            'success' => $success,
            'message' => $message,
            'data' => $data,
            'errors' => $errors
        ]);

        return $response;
    }
}
