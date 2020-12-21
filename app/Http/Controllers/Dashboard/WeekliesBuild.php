<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeekliesBuild extends Controller
{
    public const SAVE_TO = 'content/weekly';

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $saveTo = self::SAVE_TO;

        // get all weeklies from DB
        // iterate over all weeklies
        // generate markdown for all
        return "saving weeklies markdown into {$saveTo}";
    }
}
