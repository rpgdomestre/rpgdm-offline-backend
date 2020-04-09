<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class LinksIndex extends Controller
{
    public function __invoke(Request $request)
    {
        $links = Link::orderBy('id', 'desc')
            ->paginate(20);

        return view('links.index', compact('links'));
    }
}
