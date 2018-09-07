<?php

namespace App\Models\Helpers\FileMediaInfo;

class FileIcon
{
    /**
     * @var array
     */
    protected $supportedFileExtensions;

    /**
     * Create a new FileIcon instance.
     * Read the catalog of available file icons and saves it to $supportedFileExtensions as an array
     */
    public function __construct()
    {
        $this->supportedFileExtensions = json_decode(
            file_get_contents(base_path("node_modules/file-icon-vectors/dist/icons/vivid/catalog.json"))
        );
    }

    /**
     * Determine if there is an icon for provided file extension.
     *
     * @param string $fileExtension
     * @return bool
     */
    public function hasRelatedIcon(string $fileExtension): bool
    {
        return in_array($fileExtension,$this->supportedFileExtensions) ? true : false;
    }
}