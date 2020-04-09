<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SectionsCreate extends Controller
{
    public function __invoke(Request $request)
    {
        return view('links.sections.create');
    }
}
