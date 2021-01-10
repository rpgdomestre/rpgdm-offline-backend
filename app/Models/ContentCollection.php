<?php

namespace App\Models;

use App;
use App\Actions\Rpgdm\ReadMarkdownContent;
use Illuminate\Support\Collection;

class ContentCollection
{
    private Collection $entries;

    public function __construct(
        private Content $content,
        private CollectionEntry $collectionEntry,
        private ReadMarkdownContent $markdownReader
    ) { }

    public function publish(string $collection, array $metadata): Collection
    {
        $collectionDestination = $metadata['to'] ?? $collection;
        $collectionSlugConfig = $metadata['slugConfig'] ?? '';

        $this->entries = $this->content->getEntriesFor($collection)
            ->reject(function ($entry) {
                if (App::environment(['local', 'staging', 'stage'])) {
                    return false;
                }

                $yaml = $this->markdownReader->getYaml($entry->getPathname());
                return $yaml['draft'] ?? false;
            })
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
