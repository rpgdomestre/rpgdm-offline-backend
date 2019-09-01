<?php

namespace App\Http\Controllers;

use App\Section;
use App\Weekly;
use Illuminate\Http\Request;

class LinksCreate extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function __invoke(Request $request)
    {
        $sections = Section::all(['id', 'name']);

        $newWeekly = Weekly::count();

        return view('links.create', compact('sections', 'newWeekly'));
    }
}
