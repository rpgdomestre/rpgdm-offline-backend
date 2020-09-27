<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Weekly;
use App\Http\Controllers\Controller;
use App\Requests\UpdateWeeklies;

class WeekliesUpdate extends Controller
{
    public function __invoke(UpdateWeeklies $request, Weekly $weekly)
    {
        Weekly::whereId($weekly->id)
            ->update($request->validated());

        return redirect()
            ->route('weeklies.edit', ['weekly' => $weekly->id])
            ->with(
                'status',
                "Weekly <strong>#{$weekly->edition}</strong> updated!"
            );
    }
}
