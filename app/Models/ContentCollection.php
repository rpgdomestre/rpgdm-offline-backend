<?php

namespace App\Models;

use Illuminate\Support\Collection;

class ContentCollection
{
    private Collection $entries;

    public function __construct(
        private Content $content,
        private CollectionEntry $collectionEntry
    ) { }

    public function publish(string $collection, array $metadata): Collection
    {
        $collectionDestination = $metadata['to'] ?? $collection;
        $collectionSlugConfig = $metadata['slugConfig'] ?? '';

        $this->entries = $this->content->getEntriesFor($collection)
            ->mapInto(MarkdownFile::class)
            ->map(function ($entry) use ($collectionDestination, $collectionSlugConfig) {
                return $this->collectionEntry->save(
                    $entry->getPathname(),
                    $collectionDestination,
                    $collectionSlugConfig,
                );
            })
            ->sortByDesc('time');

        return collect($this->entries);
    }
}
