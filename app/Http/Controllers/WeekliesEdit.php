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
        $today = Carbon::today()->setTime(0, 0, 0, 0);
        $links = $weekly->fetchAllLinksSortedByIdDesc($weekly);

        return view(
            'weeklies.edit',
            compact(
                'weekly',
                'today',
                'links'
            )
        );
    }
}
