<?php

namespace App\Actions\Rpgdm;

use Illuminate\Support\Facades\File;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\Footnote\FootnoteExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\TableOfContents\TableOfContentsExtension;
use Mni\FrontYAML\Parser;
use \Mni\FrontYAML\Bridge\CommonMark\CommonMarkParser;

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
            $parser = new Parser(null, $this->getConfiguredCommonMarkParser());
            $this->markdown = $parser->parse($markdown);
        }

        return $this->markdown;
    }

    private function getConfiguredCommonMarkParser(): CommonMarkParser
    {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new AttributesExtension());
        $environment->addExtension(new AutolinkExtension());
        $environment->addExtension(new FootnoteExtension());
        $environment->addExtension(new HeadingPermalinkExtension());
        $environment->addExtension(new TableExtension());
        $environment->addExtension(new TableOfContentsExtension());

        $config = [
            'external_link' => [
                'internal_hosts' => config('rpgdm.url'), // TODO: Don't forget to set this!
            ],
            'footnote' => [],
            'heading_permalink' => [
                'symbol' => '',
            ],
            'table_of_contents' => [
                'position' => 'placeholder',
                'placeholder' => '[TOC]'
            ]
        ];

        $converter = new CommonMarkConverter($config, $environment);

        return new CommonMarkParser($converter);
    }
}
