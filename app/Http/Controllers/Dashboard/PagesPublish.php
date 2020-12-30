<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Rpgdm\ReadMarkdownContent;
use App\Helpers\HtmlPublisher;
use Illuminate\Support\Facades\File;

class PagesPublish extends Controller
{
    private const SAVE_TO = '';
    public const FROM = 'content/pages';

    public function __construct(
        private ReadMarkdownContent $markdownReader,
        private HtmlPublisher $publisher,
    ) {}

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $pages = File::allFiles(base_path(self::FROM));

        foreach ($pages as $page) {
            $path = $page->getPathname();
            $yaml = $this->markdownReader->getYaml($path);
            $body = $this->markdownReader->getBody($path);

            $content = view($yaml['template'], [
                'content' => $body,
                'title' => $yaml['title'],
                'color' => $yaml['color'] ?? '',
                'parent' => $yaml['parent'] ?? '',
                'description' => $yaml['description'] ?? ''
            ]);

            $metadata = $this->getFolderMeta($page->getRelativePath());
            $this->publisher->save(metadata: $metadata, content: $content);
        }

        // returns to weeklies page with success message
        return redirect()->route('pages.index')
            ->with(
                'status',
                "All <strong>Pages</strong> published!"
            );
    }

    private function getFolderMeta(string $path): array
    {
        return [
            public_path(self::SAVE_TO),
            $path
        ];
    }
}
