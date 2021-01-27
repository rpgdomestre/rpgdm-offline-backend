<?php

namespace App\Tasks;

use App\Contracts\Pathable;
use App\Helpers\HtmlPublisher;
use App\Traits\FolderMetaIdentity;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class SaveCollectionsEntries implements Pathable
{
    use FolderMetaIdentity;

    public function __construct(
        private HtmlPublisher $publisher,
    ) {
    }

    public function handle($content, Closure $next)
    {
        $content = $content->each->each(function ($entry) {
            $metadata = $this->getFolderMeta(
                $entry['collection']->from,
                $entry['collection']->slugConfig,
                $entry['meta']['date'],
                $entry['meta']['title']
            );

            $body = $this->getCollectionEntryHtml(
                $entry['meta'],
                $entry['body']
            );

            $this->publisher->save(
                $metadata,
                (string) $body
            );
        });

        return $next($content);
    }

    public function getCollectionEntryHtml(array $yaml, string $body): View
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
