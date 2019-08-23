<?php

namespace App\Controller\Api;

use App\Entity\Media;
use App\Entity\MediaType;
use App\Entity\Folder;
use App\Service\UploaderHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\Date;

class MediaController extends AbstractController
{
    /**
     * @var UploaderHelper
     */
    private $uploaderHelper;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * MediaController constructor.
     *
     * @param UploaderHelper $uploaderHelper
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        UploaderHelper $uploaderHelper,
        EntityManagerInterface $entityManager
    ) {
        $this->uploaderHelper = $uploaderHelper;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/api/media/upload", name="api_media_upload", methods={"POST"})
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function uploadAction(Request $request): JsonResponse
    {
        $success = false;
        $errors = [];
        $message = 'Upload failed. Please try again.';
        $file = $request->files->get('file');

        if ($file instanceof UploadedFile) {
            $newFile = $this->uploaderHelper->uploadMedia($file);
            $message = 'Upload successfully';
            $success = true;

            /** @var Media $media */
            $media = new Media();
            $media->setFile($newFile);
            $media->setExternal(false);
            $media->setCreated(new \DateTime());

            // TODO: Insert correctly media type.
            $type = $this->entityManager
                ->getRepository(MediaType::class)
                ->find(1);
            $media->setType($type);

            $folder = $this->entityManager
                ->getRepository(Folder::class)
                ->find($request->request->get('folderId'));
            $media->setFolder($folder);

            $this->entityManager->persist($media);
            $this->entityManager->flush();
        }

        $response = new JsonResponse();
        $response->setData([
            'success' => $success,
            'message' => $message,
            'media' => $newFile,
            'errors' => $errors
        ]);

        return $response;
    }
}
