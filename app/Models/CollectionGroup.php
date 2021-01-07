<?php

namespace App\Models;

use App\Actions\Rpgdm\ReadMarkdownContent;
use App\Helpers\HtmlPublisher;
use Illuminate\Support\Collection;

class CollectionGroup
{
    public function __construct(
        private ReadMarkdownContent $markdownReader,
        private HtmlPublisher $publisher,
    ) {}

    public function save(
        array $entry,
        string $collectionDestination,
        string $collectionSlugConfig
    ): array {
        $template = $entry['template'];
        $items = $entry['items'];

        $body = view($template, compact('items'));

        // save collection


        return [
            'yaml' => [],
            'body' => (string) $body,
            'time' => now(),
            'url' => ''
        ];
    }

    public function prepare(
        Collection $collection,
        string $groupBy,
        string $template = 'pages.grouped'
    ) {
        return $collection->map(function ($entry) {
            return $this->getEntryMetadata($entry->getPathname());
        })->groupBy($groupBy)
        ->map(function ($entry) use ($template) {
            return [
                'template' => $template,
                'items' => [...$entry]
            ];
        });
    }

    private function getEntryMetadata(string $entryPath)
    {
        return $this->markdownReader->getYaml($entryPath);
    }
}
