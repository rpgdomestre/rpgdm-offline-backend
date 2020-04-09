<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class SourceTwitterCreate extends Controller
{
    private Link $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function __invoke(Request $request)
    {
        $sources = $this->link->sources();

        return view('links.sources.twitter', compact('sources'));
    }
}
