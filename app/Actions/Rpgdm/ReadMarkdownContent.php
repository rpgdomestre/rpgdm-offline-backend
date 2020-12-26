<?php

namespace App\Actions\Rpgdm;

use Illuminate\Support\Facades\File;
use Mni\FrontYAML\Parser;

class ReadMarkdownContent
{
    private $markdown;
    private string $path = '';

    public function getYaml(string $path): array
    {
        return $this->getMarkdown($path)->getYAML();
    }

    public function getBody(string $path): string
    {
        return $this->getMarkdown($path)->getContent();
    }

    private function getMarkdown(string $path)
    {
        if ($this->markdown === null || $this->path !== $path) {
            $this->path = $path;
            $markdown = File::get($path);
            $this->markdown = (new Parser())->parse($markdown);
        }

        return $this->markdown;
    }
}
