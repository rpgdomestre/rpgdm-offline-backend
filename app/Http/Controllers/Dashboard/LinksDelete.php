<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Link;
use App\Requests\RemoveLinks;
use App\Http\Controllers\Controller;

class LinksDelete extends Controller
{
    public function __invoke(RemoveLinks $request, Link $link)
    {
        $link->delete();

        return redirect()
            ->back()
            ->with('status', 'Link removed!');
    }
}
