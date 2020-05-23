<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
