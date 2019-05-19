<?php

namespace App\Http\Controllers;

use App\Weekly;
use Illuminate\Http\Request;

class WeekliesGenerateMarkdown extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Weekly $weekly
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Weekly $weekly)
    {
        $fetched = $weekly->fetchLinks($weekly->from, $weekly->to);
        $allLinks = $fetched['all'];
        $groups = $fetched['groups'];

        return view(
            'weeklies.markdown',
            compact('weekly', 'allLinks', 'groups')
        );
    }
}
