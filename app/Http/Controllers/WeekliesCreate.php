<?php

namespace App\Http\Controllers;

use App\Weekly;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeekliesCreate extends Controller
{
    /** @var \App\Weekly */
    private $weekly;

    public function __construct(Weekly $weekly)
    {
        $this->weekly = $weekly;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $from = Carbon::yesterday()->subDays(7)->setTime(0, 0, 0, 0);
        $to = Carbon::yesterday()->setTime(23, 59, 59, 999);
        $today = Carbon::today()->setTime(0, 0, 0, 0);
        $newWeekly = $this->weekly->newWeeklyNumber();

        return view(
            'weeklies.create',
            compact('from', 'to', 'today', 'newWeekly')
        );
    }
}
