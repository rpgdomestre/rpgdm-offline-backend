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

        foreach ($weeklies as $weekly) {
            $path = $weekly->getPathname();
            $yaml = $this->markdownReader->getYaml($path);
            $body = $this->markdownReader->getBody($path);

            $content = view('weeklies.published', [
                'content' => $body,
                'number' => $yaml['number'],
            ]);

            $metadata = $this->getFolderMeta($yaml);
            $this->publisher->save(metadata: $metadata, content: $content);
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
