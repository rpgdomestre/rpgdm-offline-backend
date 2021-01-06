<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Collections;
use Illuminate\Http\Request;

class CollectionsPublish extends Controller
{
    public function __construct(
        private Collections $collections,
    ) {}

    public function __invoke(Request $request)
    {
        $result = $this->collections->publishToHtml();

        return redirect()
            ->route('collections.index')
            ->with([
                'status' => "All <strong>Collections</strong> processed!",
                'results' => $result
            ]);
    }
}
