<?php

namespace App\Helpers;

use ErrorException;
use \Illuminate\Filesystem\Filesystem;

class HtmlPublisher
{
    public function __construct(private Filesystem $file) { }

    public function save(array $metadata, string $content)
    {
        $this->makeDirectory(metadata: $metadata);
        $this->saveContent(metadata: $metadata, content: $content);
    }

    private function makeDirectory(array $metadata): void
    {
        try {
            $folderPath = implode(DIRECTORY_SEPARATOR, $metadata);
            $this->file->makeDirectory(path: $folderPath, recursive: true);
        } catch (ErrorException) {
            // folder exists and we don't need to worry about it
        }
    }

    private function saveContent(array $metadata, string $content): void
    {
        $fileName = 'index.html';
        $finalFile = implode(DIRECTORY_SEPARATOR, [...$metadata, $fileName]);
        $this->file->put($finalFile, $content);
    }
}
