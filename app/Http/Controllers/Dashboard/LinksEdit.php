<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Link;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinksEdit extends Controller
{
    public function __invoke(Request $request, Link $link)
    {
        $sections = Section::all(['id', 'name']);

        return view('links.edit', compact('sections', 'link'));
    }
}
