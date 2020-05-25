<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateLinks;
use App\Link;

class LinksUpdate extends Controller
{
    public function __invoke(UpdateLinks $request, Link $link)
    {
        $linkUpdated = $request->validated();
        $linkUpdated['source'] = $linkUpdated['sourceName'];
        unset($linkUpdated['sourceName']);

        Link::find($link->id)
            ->update($linkUpdated);

        return redirect()
            ->route('links.edit', ['link' => $link->id])
            ->with('status', "Link <strong>{$linkUpdated['name']}</strong> updated!");
    }
}
