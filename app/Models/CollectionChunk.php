<?php

namespace App\Models;

use App\Helpers\HtmlPublisher;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class CollectionChunk
{
    public function __construct(private HtmlPublisher $publisher) {}

    public function publish(
        string $collection,
        Collection $entries,
        int $chunkSize,
        array $chunkExtras = []
    ) {
        $this->chunks = $entries->chunk($chunkSize);

        foreach ($this->chunks as $key => $chunk) {
            $previous = $key === 0 ? '' : $key - 1;
            $next = $key === count($this->chunks) - 1 ? '' : $key + 2;
            $page = $key + 1;
            $template = $this->getPaginatedTemplate($collection);

            $content = view(
                $template,
                [
                    'chunk' => $chunk,
                    'color' => $chunkExtras['color'] ?? 'black',
                    'next' => $next,
                    'previous' => $previous,
                    'collection' => $collection,
                    'description' => "Página #{$page} de {$collection}",
                ]
            );
            if ($key === 0) {
                $this->saveChunkPage($collection, $content);
            }

            $this->saveChunkPage($collection, $content, $key + 1);
        }
    }

    private function getPaginatedTemplate(string $collection): string
    {
        return view()->exists("{$collection}.listing")
            ? "{$collection}.listing"
            : "pages.listing";
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
