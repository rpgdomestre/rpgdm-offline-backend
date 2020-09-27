<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Section;
use App\Http\Requests\StoreSection;
use App\Http\Controllers\Controller;

class SectionsStore extends Controller
{
    public function __invoke(StoreSection $request)
    {
        $link = Section::firstOrCreate($request->validated());

        return redirect()
            ->route('sections.create')
            ->with(
                'status',
                "Section <strong>{$link->name}</strong> created!"
            );
    }
}
