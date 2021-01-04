<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Rpgdm\GenerateMarkdown;
use App\Models\Weekly;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Storage;

class WeekliesGenerateMarkdown extends Controller
{
    private GenerateMarkdown $generator;

    public function __construct(GenerateMarkdown $generator)
    {
        $this->generator = $generator;
    }
    public function __invoke(Request $request, Weekly $weekly)
    {
        $fileName = base_path("content/weekly/{$weekly->edition}.blade.md");
        $view = $this->generator->execute($weekly);

        File::put($fileName, $view);

        return redirect()->route('weeklies.index')
            ->with(
                'status',
                "<strong>Weekly #{$weekly->edition}</strong> markdown generated!"
            );
    }
}
