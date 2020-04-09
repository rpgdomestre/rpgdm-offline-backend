<?php

namespace App\Http\Controllers;

use App\Section;
use App\Weekly;
use Illuminate\Http\Request;

class LinksCreate extends Controller
{
    public function __invoke(Request $request, Weekly $weekly)
    {
        $sections = Section::all(['id', 'name']);

        $newWeekly = $weekly->latestUpdatedWeekly();

        return view(
            'links.create',
            compact('sections', 'newWeekly')
        );
    }
}
