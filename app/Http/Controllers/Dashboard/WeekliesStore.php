<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Weekly;
use App\Http\Controllers\Controller;
use App\Requests\StoreWeeklies;

class WeekliesStore extends Controller
{
    public function __invoke(StoreWeeklies $request)
    {
        $weekly = Weekly::firstOrCreate($request->validated());

        return redirect()
            ->route('weeklies.index')
            ->with(
                'status',
                "Weekly <strong>#{$weekly->edition}</strong> created!"
            );
    }
}
