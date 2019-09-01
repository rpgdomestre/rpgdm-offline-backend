<?php

namespace App\Http\Controllers;

use App\Weekly;
use Illuminate\Http\Request;

class WeekliesGenerateMarkdown extends Controller
{
    /**
     * When click on 'generate markdown' button, generates respective weekly
     * and forces download of final markdown file
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Weekly $weekly
     *
     * @return \Illuminate\Http\Response
     */
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
