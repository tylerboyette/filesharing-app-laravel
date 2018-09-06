<?php

namespace App\Models\Helpers\FileMediaInfo;

class FileMediaInfo
{
    /**
     * @var \getID3
     */
    protected $getId3;

    /**
     * @var MetaDataGrabber
     */
    protected $metaDataGrabber;

    /**
     * Create a new FileMediaInfo
     *
     * @param MetaDataGrabber $metaDataGrabber
     */
    public function __construct(MetaDataGrabber $metaDataGrabber)
    {
        $this->getId3 = new \getID3();
        $this->metaDataGrabber = $metaDataGrabber;
    }

    /**
     * Collect meta data for a file
     *
     * @param string $pathToFile
     * @return array
     */
    public function bundleFileMetaData(string $pathToFile): array
    {
        // Getting the file info using library getId3
        $fileInfo = $this->getId3->analyze($pathToFile);

        $fileMetaData = [];

        if (array_key_exists("mime_type", $fileInfo)) {
            // Getting the MIME-type of the file
            $mimeType = $fileInfo["mime_type"];

            // Exploding the MIME-type by "/" and getting the first part of the MIME-type
            $fileType = explode("/", $mimeType)[0];

            // Getting additional meta data for media files
            $fileMetaData = $this->metaDataGrabber->grabMetaDataByFileType($fileType, $fileInfo);

            // Storing MIME-type in meta data
            $fileMetaData["mime_type"] = $mimeType;
        }

        $fileMetaData["filesize"] = $fileInfo["filesize"];

        return $fileMetaData;
    }
}