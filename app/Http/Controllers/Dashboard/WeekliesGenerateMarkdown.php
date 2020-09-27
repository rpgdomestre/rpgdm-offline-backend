<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Weekly;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeekliesGenerateMarkdown extends Controller
{
    public function __invoke(Request $request, Weekly $weekly)
    {
        $fetched = $weekly->fetchLinks($weekly);
        $allLinks = $fetched['all'];
        $groups = $fetched['groups'];

        $fileName = "{$weekly->edition}.blade.md";
        $view = view(
            'weeklies.markdown',
            compact('weekly', 'allLinks', 'groups')
        );

        return response()->streamDownload(
            static function () use ($view) {
                echo $view;
            },
            $fileName,
            ['Content-Type' => 'text/markdown']
        );
    }
}
