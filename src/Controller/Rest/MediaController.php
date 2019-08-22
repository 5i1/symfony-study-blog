<?php

namespace App\Controller\Rest;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

/***
 * Media.
 *
 * @Route("/api", name="api_")
 */
class MediaController extends AbstractFOSRestController
{
    /***
     * Upload media.
     *
     * @Rest\Get("/media/upload")
     */
    public function uploadAction(Request $request)
    {
        $success = false;
        $errors = [];
        $message = 'Post creation failed. Please try again.';

        $data = [
            'success' => $success,
            'message' => $message,
            'errors' => $errors
        ];

        return View::create($data, Response::HTTP_CREATED);
    }
}
