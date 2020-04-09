<?php

namespace App\Http\Controllers;

use App\Link;
use App\Section;
use Illuminate\Http\Request;

class LinksEdit extends Controller
{
    public function __invoke(Request $request, Link $link)
    {
        $sections = Section::all(['id', 'name']);

        return view('links.edit', compact('sections', 'link'));
    }
}
