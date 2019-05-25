<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class SourceTwitterCreate extends Controller
{
    /**
     * @var \App\Link
     */
    private $link;

    /**
     * SourceTwitterCreate constructor.
     *
     * @param \App\Link $link
     */
    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $sources = $this->link->sources();

        return view('links.sources.twitter', compact('sources'));
    }
}
