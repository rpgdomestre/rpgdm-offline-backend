<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Rpgdm\GenerateMarkdown;
use App\Models\Weekly;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeekliesGenerateMarkdown extends Controller
{
    private GenerateMarkdown $generator;

    public function __construct(GenerateMarkdown $generator)
    {
        $this->generator = $generator;
    }
    public function __invoke(Request $request, Weekly $weekly)
    {
        $fileName = "{$weekly->edition}.blade.md";
        $view = $this->generator->execute($weekly);

        return response()->streamDownload(
            static function () use ($view) {
                echo $view;
            },
            $fileName,
            ['Content-Type' => 'text/markdown']
        );
    }
}
