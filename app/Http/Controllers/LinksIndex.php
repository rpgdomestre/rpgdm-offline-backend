<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class LinksIndex extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $links = Link::orderBy('id', 'desc')->get();

        return view('links.index', compact('links'));
    }
}
