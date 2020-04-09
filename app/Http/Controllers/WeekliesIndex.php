<?php

namespace App\Http\Controllers;

use App\Weekly;
use Illuminate\Http\Request;

class WeekliesIndex extends Controller
{
    public function __invoke(Request $request)
    {
        $weeklies = Weekly::orderBy('edition', 'desc')
            ->paginate(20);

        return view('weeklies.index', compact('weeklies'));
    }
}
