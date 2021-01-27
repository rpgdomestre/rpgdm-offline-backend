<?php

namespace App\Tasks;

use App\Helpers\HtmlPublisher;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class SavePaginatedCollectionsEntries
{
    public function __construct(
        private HtmlPublisher $publisher
    ) {
    }

    public function handle($content, Closure $next)
    {
        $content->each(function ($collection, $collectionName) {
            $pageCount = $collection->count();

            $collection->each(
                function ($chunk, $key) use ($pageCount, $collectionName) {
                    $template = $this->getChunkTemplate($collectionName);
                    $previous = $key === 0 ? '' : $key - 1;
                    $next = $key === $pageCount - 1 ? '' : $key + 2;
                    $page = $key + 1;

                    $content = $this->getChunkAsHtml(
                        $chunk,
                        $template,
                        $next,
                        $previous,
                        $page,
                        $collectionName
                    );

                    if ($key === 0) {
                        $this->saveChunkPage($collectionName, $content);
                    }

                    $this->saveChunkPage($collectionName, $content, $key + 1);
                }
            );
        });

        return $next($content);
    }

    private function getChunkTemplate(string $collection): string
    {
        return view()->exists("{$collection}.listing")
            ? "{$collection}.listing"
            : "pages.listing";
    }

    private function getChunkAsHtml(
        Collection $chunk,
        string $template,
        int|string $next,
        int|string $previous,
        int $page,
        string $collectionName
    ): View {
        $color = $chunk->first()['collection']->color ?? 'black';
        $extras = $chunk->first()['collection']->extras ?? [];

        return view(
            $template,
            [
                'chunk' => $chunk,
                'color' => $color,
                'next' => $next,
                'previous' => $previous,
                'collection' => $collectionName,
                'description' => "Página #{$page} de {$collectionName}",
                'extras' => $extras,
            ]
        );
    }

    private function saveChunkPage(
        string $collection,
        View $content,
        ?int $pageNumber = null
    ) {
        $this->publisher->save(
            metadata: array_filter([
                public_path(''),
                $collection,
                ...[$pageNumber]
            ]),
            content: $content
        );
    }
}
