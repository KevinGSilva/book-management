<?php

namespace App\Services;

use Illuminate\Validation\ValidationException;

class ApiImagesService
{
    public function decodeImageBase64($book, $cover)
    {
        $imageData = base64_decode($cover);

        $imageInfo = getimagesizefromstring($imageData);
        if ($imageInfo === false) {
            throw new \Exception('Arquivo de imagem inválido');
        }

        $mimeType = $imageInfo['mime'];
        $extension = '';
        switch ($mimeType) {
            case 'image/jpeg':
                $extension = 'jpg';
                break;
            case 'image/png':
                $extension = 'png';
                break;
            case 'image/gif':
                $extension = 'gif';
                break;
            default:
                throw new \Exception('Tipo de imagem inválido');
        }

        $imageName = 'cover_' . uniqid() . '.' . $extension;
        $tempFile = tmpfile();
        fwrite($tempFile, $imageData);
        $filePath = stream_get_meta_data($tempFile)['uri'];

        $book->addMedia($filePath)
            ->toMediaCollection('cover');

        fclose($tempFile);
    }
}