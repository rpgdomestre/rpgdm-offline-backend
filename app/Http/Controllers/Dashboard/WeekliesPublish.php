<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use DateTime;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mni\FrontYAML\Parser;

class WeekliesPublish extends Controller
{
    private const SAVE_TO = "publish"
        . DIRECTORY_SEPARATOR
        . "weekly";

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // get all weeklies markdown
        $weeklies = File::allFiles(base_path(WeekliesBuild::SAVE_TO));

        // iterate over them
        foreach ($weeklies as $weekly) {
            // generate full page html
            $contents = File::get($weekly->getPathname());
            $contents = (new Parser())->parse($contents);
            $yaml = $contents->getYAML();
            $content = $contents->getContent();

            // adds HTML wrapper around content

            // make folder if it doesn't exist
            $yearWeek = date('Y-W', strtotime($yaml['date']));
            $folderMeta = [
                base_path(self::SAVE_TO),
                $yearWeek,
                $yaml['number'],
            ];

            try {
                $folderPath = implode(DIRECTORY_SEPARATOR, $folderMeta);
                File::makeDirectory(path: $folderPath, recursive: true);
            } catch (ErrorException) {
                // folder exists and we don't need to worry about it
            }

            // save to publish\weekly
            $fileName = 'index.html';
            $finalFile = implode(DIRECTORY_SEPARATOR, [...$folderMeta, $fileName]);
            File::put($finalFile, $content);
        }

        // returns to weeklies page with success message
        return redirect()
            ->route('weeklies.index')
            ->with(
                'status',
                "All <strong>Weeklies</strong> published!"
            );
    }
}
