<?php

namespace App\Models;

class MarkdownFile
{
    public function __construct(private $entry) {}

    public function getPathname(): string
    {
        return $this->entry->getPathname();
    }
}
