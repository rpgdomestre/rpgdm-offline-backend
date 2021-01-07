<?php

namespace App\Models;

use Illuminate\Support\Collection;

class ContentCollection
{
    private Collection $entries;

    public function __construct(
        private Content $content,
        private CollectionEntry $collectionEntry,
        private CollectionGroup $collectionGroup,
    ) { }

    public function publish(string $collection, array $metadata): Collection
    {
        $collectionDestination = $metadata['to'] ?? $collection;
        $collectionSlugConfig = $metadata['slugConfig'] ?? '';

        $this->entries = $this->content->getEntriesFor($collection)
            ->mapInto(MarkdownFile::class);

        if ($metadata['group'] ?? false) {
            $this->entries = $this->collectionGroup->prepare(
                $this->entries,
                $metadata['group']
            );
        }

        $this->entries = $this->entries->map(
            function ($entry) use ($collectionDestination, $collectionSlugConfig)
            {
                $collectionToUse = is_object($entry)
                    ? $this->collectionEntry
                    : $this->collectionGroup;

                return $collectionToUse->save(
                    is_object($entry) ? $entry->getPathname() : $entry,
                    $collectionDestination,
                    $collectionSlugConfig,
                );
            }
        )->sortByDesc($metadata['sort'] ?? 'time');

        return collect($this->entries);
    }
}
