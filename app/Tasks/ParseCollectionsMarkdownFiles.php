<?php

namespace App\Tasks;

use App\Actions\Rpgdm\ReadMarkdownContent;
use App\Models\MarkdownFile;
use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ParseCollectionsMarkdownFiles
{
    public function __construct(
        private ReadMarkdownContent $markdown,
    ) {
    }

    public function handle($content, Closure $next)
    {
        /** @var Collection $content */
        $content = $content
            /** @var Collection $collection */
            ->map(function ($collection) {
                if (is_array($collection)) {
                    return collect([]);
                }

                return $collection->map(function ($entry) {
                    $yaml = $this->markdown->getYaml(
                        $entry->getPathname()
                    );

                    return collect([
                        'path' => $entry->getPathname(),
                        'collection' => $entry->getCollection(),
                        'meta' => $yaml,
                        'time' => strtotime($yaml['date']),
                        'url' => $this->getEntryUrl($entry, $yaml),
                        'body' => $this->markdown->getBody(
                            $entry->getPathname()
                        )
                    ]);
                }) ?? collect([]);
            });

        return $next($content);
    }

    public function getEntryUrl(MarkdownFile $entry, array $yaml): string
    {
        $slugConfig = $entry->getCollection()->slugConfig;

        $dateFolder = date($slugConfig, strtotime($yaml['date']));

        return implode(DIRECTORY_SEPARATOR, [
            $entry->getCollection()->to,
            $dateFolder,
            Str::of($yaml['title'])->slug(),
        ]);
    }
}
