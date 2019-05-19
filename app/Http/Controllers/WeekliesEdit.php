<?php

namespace App\Http\Controllers;

use App\Weekly;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeekliesEdit extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Weekly $weekly
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Weekly $weekly)
    {
        $from = Carbon::yesterday()->subDays(7)->setTime(0, 0, 0, 0);
        $to = Carbon::yesterday()->setTime(23, 59, 59, 999);
        $today = Carbon::today()->setTime(0, 0, 0, 0);

        return view('weeklies.edit', compact('weekly', 'from', 'to', 'today'));
    }
}
