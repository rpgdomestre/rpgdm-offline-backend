<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;

class CollectionsIndex extends Controller
{
    public function __invoke(Request $request)
    {
        $collections = config('rpgdm.collections');

        foreach ($collections as $collection => $metadata) {
            try {
                $from = $metadata['from'] ?? $collection;
                $entries = count(File::allFiles(base_path('content' . DIRECTORY_SEPARATOR . $from)));
            } catch (DirectoryNotFoundException) {
                $entries = 0;
            }

            $collections[$collection]['entries'] = $entries;
        }

        return view('collections.index', compact('collections'));
    }
}
