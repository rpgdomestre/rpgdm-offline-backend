<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;

class CollectionsIndex extends Controller
{
    public function __construct(
        private Content $content
    ) {}

    public function __invoke(Request $request)
    {
        $collections = config('rpgdm.collections');

        foreach ($collections as $collection => $metadata) {
            try {
                $from = $metadata['from'] ?? $collection;
                $isHidden = $metadata['hidden'] ?? false;
                $entries = $this->content->getEntriesFor($from)->count();
            } catch (DirectoryNotFoundException) {
                $entries = 0;
            }

            $collections[$collection]['entries'] = $entries;
            $collections[$collection]['isHidden'] = $isHidden;
        }

        return view('collections.index', compact('collections'));
    }
}
