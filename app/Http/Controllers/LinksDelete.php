<?php


namespace App\Http\Controllers;


use App\Http\Requests\RemoveLinks;
use App\Link;

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
