<?php

namespace App\Models;

use App\Tasks\EncodeCollectionsConfig;
use App\Tasks\GenerateCollectionsReport;
use App\Tasks\OrderCollectionsEntries;
use App\Tasks\GetCollectionsMarkdownFiles;
use App\Tasks\PaginateCollectionsEntries;
use App\Tasks\ParseCollectionsMarkdownFiles;
use App\Tasks\RemoveCollectionsDraftEntries;
use App\Tasks\RemoveHiddenCollections;
use App\Tasks\SaveCollectionsEntries;
use App\Tasks\SavePaginatedCollectionsEntries;
use Illuminate\Pipeline\Pipeline;

class Collections
{
    public function publishToHtml(): array
    {
        return app(Pipeline::class)
            ->send(config('rpgdm.collections'))
            ->through([
                EncodeCollectionsConfig::class,
                RemoveHiddenCollections::class,
                GetCollectionsMarkdownFiles::class,
                ParseCollectionsMarkdownFiles::class,
                RemoveCollectionsDraftEntries::class,
                OrderCollectionsEntries::class,
                SaveCollectionsEntries::class,
                PaginateCollectionsEntries::class,
                SavePaginatedCollectionsEntries::class,
                GenerateCollectionsReport::class,
            ])
            ->then(function ($content) {
                return $content->toArray();
            });
    }
}
