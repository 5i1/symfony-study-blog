<?php
namespace App\Service;

use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
    private $uploadsMediaPath;
    private $projectDir;

    public function __construct(string $uploadsMediaPath, string $projectDir)
    {
        $this->uploadsMediaPath = $uploadsMediaPath;
        $this->projectDir = $projectDir;
    }

    public function uploadMedia(UploadedFile $uploadedFile): string
    {
        $mediaPath = $this->uploadsMediaPath . '/'. date('Y') . '/' . date('m');
        $destination = $this->projectDir . '/public/' . $mediaPath;

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);

        $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();

        $uploadedFile->move(
            $destination,
            $newFilename
        );

        return $mediaPath . '/' . $newFilename;
    }
}