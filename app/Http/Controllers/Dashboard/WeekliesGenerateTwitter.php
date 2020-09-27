<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Weekly;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeekliesGenerateTwitter extends Controller
{
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
