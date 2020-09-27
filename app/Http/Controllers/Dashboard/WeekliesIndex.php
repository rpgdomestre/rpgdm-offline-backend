<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Weekly;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeekliesIndex extends Controller
{
    public function __invoke(Request $request)
    {
        $weeklies = Weekly::orderBy('edition', 'desc')
            ->paginate(20);

        return view('weeklies.index', compact('weeklies'));
    }
}
