<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait FolderMetaIdentity
{
    public function getFolderMeta(
        string $firstLevelFolder,
        string $collectionSlugConfig,
        int|string $publishedTimestamp,
        string $folderName
    ): array {
        $baseSlugPath = [];
        if ($collectionSlugConfig !== '') {
            $baseSlugPath[] = $this->getBaseSlugPath(
                $collectionSlugConfig,
                $publishedTimestamp
            );
        }

        return [
            public_path(),
            $firstLevelFolder,
            ...$baseSlugPath,
            Str::slug($folderName),
        ];
    }
}
