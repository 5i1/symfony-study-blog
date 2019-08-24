<?php
namespace App\Service;

use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UploaderHelper
{
    private $uploadsMediaPath;
    private $projectDir;

    public function __construct(string $uploadsMediaPath, string $projectDir)
    {
        $this->uploadsMediaPath = $uploadsMediaPath;
        $this->projectDir = $projectDir;
    }

    /**
     * Make upload any file and set in uploads folder.
     *
     * @param UploadedFile $uploadedFile
     *
     * @return String[]
     */
    public function uploadMedia(UploadedFile $uploadedFile): array
    {
        $mediaPath = $this->uploadsMediaPath . '/'. date('Y') . '/' . date('m');
        $destination = $this->projectDir . '/public/' . $mediaPath;

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);

        $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();

        $uploadedFile->move(
            $destination,
            $newFilename
        );

        return [
            'file' => $mediaPath . '/' . $newFilename,
            'name' => $newFilename
        ];
    }
}