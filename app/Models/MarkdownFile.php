<?php

namespace App\Models;

use stdClass;

class MarkdownFile
{
    public function __construct(private $entry)
    {
    }

    public function getPathname(): string
    {
        return $this->entry->file->getPathname();
    }

    public function getCollection(): stdClass
    {
        return $this->entry->collection;
    }
}
