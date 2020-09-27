<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinksCreate extends Controller
{
    public function __invoke(Request $request)
    {
        // new link
        $linkData = [];

        return view(
            'links.create',
            compact('linkData')
        );
    }
}
