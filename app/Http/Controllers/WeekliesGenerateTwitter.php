<?php

namespace App\Http\Controllers;

use App\Weekly;
use Illuminate\Http\Request;

class WeekliesGenerateTwitter extends Controller
{
    /**
     * When click on 'generate ty' button, generates respective weekly thank you
     * twitter handles to paste on twitter
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Weekly $weekly
     *
     * @return void
     */
    public function __invoke(Request $request, Weekly $weekly)
    {
        // gets all links than filter buy twitter handle without duplicates
        $all = collect($weekly->fetchLinksForTwitter($weekly))
            ->unique('twitter.twitter')
            ->values()
            ->all();

        return view('weeklies.twitter', compact('all'));
    }
}
