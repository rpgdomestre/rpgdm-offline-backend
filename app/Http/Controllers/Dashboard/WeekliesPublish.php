<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Rpgdm\ReadMarkdownContent;
use App\Helpers\HtmlPublisher;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WeekliesPublish extends Controller
{
    private const SAVE_TO = "weekly";

    public function __construct(
        private ReadMarkdownContent $markdownReader,
        private HtmlPublisher $publisher
    ) {}

    public function __invoke(Request $request): RedirectResponse
    {
        $weeklies = File::allFiles(base_path(WeekliesBuild::SAVE_TO));

        $chunks = collect($weeklies)->map(function ($weekly) {
            $path = $weekly->getPathname();
            $yaml = $this->markdownReader->getYaml($path);
            $body = $this->markdownReader->getBody($path);
            $yaml['title'] = "Weekly #{$yaml['number']}";

            $content = view('weeklies.published', [
                'content' => $body,
                'number' => $yaml['number'],
                'description' => $yaml['description'],
            ]);

            $metadata = $this->getFolderMeta($yaml);

            $this->publisher->save(metadata: $metadata, content: $content);
            array_shift($metadata);
            $url = implode(DIRECTORY_SEPARATOR, ['weekly', ...$metadata]);
            return ['number' => (int) $yaml['number'], 'yaml' => $yaml, 'body' => $body, 'url' => $url];
        })->sortByDesc('number')
          ->chunk(config('rpgdm.collections')['weekly']['chunk'] ?? 10);

        // TODO: create pagination much like for pages
        foreach ($chunks as $key => $chunk) {
            $collection = 'weekly';
            $color = 'blue';
            $page = $key + 1;
            $previous = $page === 1 ? '' : $page - 1;
            $next = $page === count($chunks) ? '' : $page + 1;

            $content = view(
                "pages.listing",
                [
                    'chunk' => $chunk,
                    'color' => $color,
                    'next' => $next,
                    'previous' => $previous,
                    'collection' => $collection,
                    'description' => "Página #{$page} da {$collection}",
                ]
            );
            if ($key === 0) {
                $this->publisher->save(
                    metadata: [
                        public_path(self::SAVE_TO)
                    ],
                    content: $content
                );
            }
            $this->publisher->save(
                metadata: [
                    public_path(self::SAVE_TO),
                    $key + 1
                ],
                content: $content
            );
        }

        // returns to weeklies page with success message
        return redirect()->route('weeklies.index')
            ->with(
                'status',
                "All <strong>Weeklies</strong> published!"
            );
    }

    private function getFolderMeta(array $metadata): array
    {
        $yearWeek = date('Y-W', strtotime($metadata['date']));

        return [
            public_path(self::SAVE_TO),
            $yearWeek,
            $metadata['number'],
        ];
    }
}
