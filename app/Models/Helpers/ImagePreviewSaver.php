<?php

namespace App\Models\Helpers;

class ImagePreviewSaver
{
    public function save($preview, string $savePath, string $saveName)
    {
        if (!file_exists($savePath)) {
            mkdir($savePath, 0777, true);
        }

        $preview->save($savePath."/".$saveName);
    }
}