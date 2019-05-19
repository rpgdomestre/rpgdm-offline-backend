<?php

namespace App\Http\Controllers;

use App\Weekly;
use Illuminate\Http\Request;

class WeekliesIndex extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $weeklies = Weekly::orderBy('id', 'desc')->get();

        return view('weeklies.index', compact('weeklies'));
    }
}
