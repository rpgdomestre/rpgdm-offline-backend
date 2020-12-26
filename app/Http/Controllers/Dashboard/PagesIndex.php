<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\Request;

class PagesIndex extends Controller
{
    private Pages $pages;

    public function __construct(Pages $pages)
    {
        $this->pages = $pages;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $pages = $this->pages->all();

        return view('pages.index', compact('pages'));
    }
}
