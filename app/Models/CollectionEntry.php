<?php

namespace App\Models;

use App\Actions\Rpgdm\ReadMarkdownContent;
use App\Contracts\Pathable;
use App\Helpers\HtmlPublisher;
use App\Traits\FolderMetaIdentity;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class CollectionEntry implements Pathable
{
    use FolderMetaIdentity;

    public function __construct(
        private ReadMarkdownContent $markdownReader,
        private HtmlPublisher $publisher,
    ) {}

    public function save(
        string $entryPath,
        string $collectionDestination,
        string $collectionSlugConfig
    ): array {
        $yaml = $this->markdownReader->getYaml($entryPath);
        $body = $this->markdownReader->getBody($entryPath);

        $content = $this->getCollectionEntryHtml($yaml, $body);

        $metadata = $this->getFolderMeta(
            $collectionDestination,
            $collectionSlugConfig,
            $yaml['date'],
            $yaml['title']
        );

        $this->publisher->save($metadata, (string) $content);

        // removes public path initial entry
        array_shift($metadata);

        return [
            'url' => implode(DIRECTORY_SEPARATOR, $metadata),
            'yaml' => $yaml,
            'body' => $body,
            'time' => strtotime($yaml['date'])
        ];
    }

    private function getCollectionEntryHtml(array $yaml, string $body): View
    {
        return view($yaml['template'], [
            'content' => $body,
            'title' => $yaml['title'],
            'color' => $yaml['color'] ?? '',
            'parent' => Str::title($yaml['parent'] ?? ''),
            'description' => $yaml['description'] ?? ''
        ]);
    }
}
