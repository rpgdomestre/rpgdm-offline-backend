<?php

namespace App\Contracts;

interface Pathable
{
    public function getFolderMeta(
        string $firstLevelFolder,
        string $collectionSlugConfig,
        int|string $publishedTimestamp,
        string $folderName
    ): array;
}
