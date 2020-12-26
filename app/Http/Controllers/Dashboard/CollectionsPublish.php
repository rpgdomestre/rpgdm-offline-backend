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
                $entries = File::allFiles(base_path('content' . DIRECTORY_SEPARATOR . $from));

                collect($entries)->each(function ($entry, $key) use ($to) {
                    $path = $entry->getPathname();
                    $yaml = $this->markdownReader->getYaml($path);
                    $body = $this->markdownReader->getBody($path);

                    $content = view($yaml['template'], [
                        'content' => $body,
                        'title' => $yaml['title'],
                        'color' => $yaml['color'] ?? '',
                        'parent' => Str::title($yaml['parent'] ?? '')
                    ]);

                    $metadata = $this->getFolderMeta($yaml, $to);
                    $this->publisher->save(metadata: $metadata, content: $content);
                });
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
