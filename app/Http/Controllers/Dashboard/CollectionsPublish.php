<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Rpgdm\ReadMarkdownContent;
use App\Helpers\HtmlPublisher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;

class CollectionsPublish extends Controller
{
    private const SAVE_TO = '';

    public function __construct(
        private ReadMarkdownContent $markdownReader,
        private HtmlPublisher $publisher
    ) {}

    public function __invoke(Request $request)
    {
        $collections = config('rpgdm.collections');

        $contents = [];
        foreach ($collections as $collection => $metadata) {
            $entries = [];
            try {
                $from = $metadata['from'] ?? $collection;
                $to = $metadata['to'] ?? $collection;
                $color = $metadata['color'] ?? 'black';
                $entries = File::allFiles(base_path('content' . DIRECTORY_SEPARATOR . $from));

                $chunks = collect($entries)->map(function ($entry) use ($to) {
                    $path = $entry->getPathname();
                    $yaml = $this->markdownReader->getYaml($path);
                    $body = $this->markdownReader->getBody($path);

                    $content = view($yaml['template'], [
                        'content' => $body,
                        'title' => $yaml['title'],
                        'color' => $yaml['color'] ?? '',
                        'parent' => Str::title($yaml['parent'] ?? ''),
                        'description' => $yaml['description'] ?? ''
                    ]);

                    $metadata = $this->getFolderMeta($yaml, $to);
                    $this->publisher->save(metadata: $metadata, content: $content);

                    array_shift($metadata);
                    $url = implode(DIRECTORY_SEPARATOR, $metadata);
                    return [
                        'yaml' => $yaml,
                        'body' => $body,
                        'url' => $url,
                        'time' => strtotime($yaml['date'])
                    ];
                })
                ->sortByDesc('time')
                ->chunk($collections[$collection]['chunk'] ?? 10);

                // generate paginated pages as necessary
                foreach ($chunks as $key => $chunk) {
                    $previous = $key === 0 ? '' : $key - 1;
                    $next = $key === count($chunks) - 1 ? '' : $key + 2;
                    $page = $key + 1;
                    $content = view(
                        "pages.listing",
                        [
                            'chunk' => $chunk,
                            'color' => $color,
                            'next' => $next,
                            'previous' => $previous,
                            'collection' => $collection,
                            'description' => "Página #{$page} de {$collection}",
                        ]
                    );
                    if ($key === 0) {
                        $this->publisher->save(
                            metadata: [
                                public_path(self::SAVE_TO),
                                $collection
                            ],
                            content: $content
                        );
                    }
                    $this->publisher->save(
                        metadata: [
                            public_path(self::SAVE_TO),
                            $collection,
                            $key + 1
                        ],
                        content: $content
                    );
                }
                // first entry is the index.html from newer to older
                // second goes folder /2/index.html then /3/index.html
                // and so on and so forth
            } catch (DirectoryNotFoundException) {
                $contents[$collection] = [];
            }
        }

        // redirect back with flash message
        return redirect()->route('collections.index')
        ->with(
            'status',
            "All <strong>Collections</strong> published!"
        );
    }

    private function getFolderMeta(array $metadata, string $collection): array
    {
        $yearMonth = date('Y\/m', strtotime($metadata['date']));
        $title = Str::slug($metadata['title'], '-');

        return [
            public_path(self::SAVE_TO),
            $collection,
            $yearMonth,
            $title
        ];
    }
}
