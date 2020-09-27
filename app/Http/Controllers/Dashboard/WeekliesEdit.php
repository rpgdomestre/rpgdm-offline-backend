<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Weekly;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeekliesEdit extends Controller
{
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
