<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateLinks;
use App\Link;

class LinksUpdate extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\UpdateLinks $request
     *
     * @param \App\Link $link
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateLinks $request, Link $link)
    {
        Link::find($link->id)
            ->update($request->validated());

        return redirect()
            ->route('links.edit', ['link' => $link->id])
            ->with('status', "Link <strong>{$link->name}</strong> updated!");
    }
}
