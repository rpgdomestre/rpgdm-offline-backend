<?php

namespace App\Http\Controllers;

use App\Section;
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

        return view('links.create', compact('sections'));
    }
}
