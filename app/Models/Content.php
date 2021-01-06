<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Content
{
    public function getEntriesFor(string $collectionName)
    {
        $path = implode(DIRECTORY_SEPARATOR, [
            'content',
            $collectionName
        ]);

        return collect(File::allFiles(base_path($path)))
            ->filter(function ($entry) {
                $allowedExtensions = config('rpgdm.contentExtensions', ['.md']);

                return Str::endsWith($entry->getPathname(), $allowedExtensions);
            });
    }
}
