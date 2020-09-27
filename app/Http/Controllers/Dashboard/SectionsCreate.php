<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionsCreate extends Controller
{
    public function __invoke(Request $request)
    {
        return view('links.sections.create');
    }
}
