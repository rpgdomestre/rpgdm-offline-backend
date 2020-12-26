<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Mni\FrontYAML\Parser;

class Pages
{
    public const MARKDOWN_PATH = 'content/pages';

    public function all()
    {
        $pages = collect(File::allFiles(base_path(self::MARKDOWN_PATH)));
        $pages = $pages->map(function ($page, $key) {
            return $this->getEnhancedMetadata($page);
        })->sortBy(fn ($page) => $page->path);

        return $pages;
    }

    private function getEnhancedMetadata($page)
    {
        $contents = File::get($page->getPathname());
        $contents = (new Parser())->parse($contents);

        $metadata = $contents->getYAML();
        $page->title = $metadata['title'];
        $page->parent = $metadata['parent'];
        $page->uuid = $metadata['uuid'];
        $page->path = $page->getRelativePath() == ""
            ? "/"
            : $page->getRelativePath();

        return $page;
    }
}
