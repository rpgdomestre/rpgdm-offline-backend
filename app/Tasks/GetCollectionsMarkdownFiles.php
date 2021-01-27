<?php

namespace App\Tasks;

use App\Actions\Rpgdm\ReadMarkdownContent;
use App\Models\Content;
use App\Models\MarkdownFile;
use Closure;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;

class GetCollectionsMarkdownFiles
{
    public function __construct(
        private Content $content,
        private ReadMarkdownContent $markdownReader
    ) {
    }

    public function handle($content, Closure $next)
    {
        $content = collect($content)
            ->map(function ($metadata, $collection) {
                try {
                    $entries = $this
                        ->content
                        ->getEntriesFor($collection)
                        ->map(function ($entry) use ($metadata) {
                            return (object) [
                                'collection' => (object) $metadata,
                                'file' => $entry
                            ];
                        });
                } catch (DirectoryNotFoundException) {
                    return collect([]);
                }

                return $entries->mapInto(MarkdownFile::class);
            });

        return $next($content);
    }
}
