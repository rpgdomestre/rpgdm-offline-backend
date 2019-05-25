<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSourceTwitter;
use App\Link;
use App\SourceTwitter;

class SourceTwitterStore extends Controller
{
    /**
     * @var \App\SourceTwitter
     */
    private $twitters;
    /**
     * @var \App\Link
     */
    private $link;

    /**
     * SourceTwitterStore constructor.
     *
     * @param \App\SourceTwitter $twitters
     * @param \App\Link $link
     */
    public function __construct(
        SourceTwitter $twitters,
        Link $link
    ) {
        $this->twitters = $twitters;
        $this->link = $link;
    }

    /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\StoreSourceTwitter $request
     *
     * @return void
     */
    public function __invoke(StoreSourceTwitter $request)
    {
        $sources = $request->get('source');
        $twitters = $request->get('twitter');
        $countSources = count($sources);
        $inserts = [];

        if ($countSources) {
            $this->twitters->truncate();

            $inserts = array_map(
                static function (int $number) use ($sources, $twitters) {
                    return ['source' => $sources[$number], 'twitter' => $twitters[$number]];
                },
                range(0, $countSources - 1)
            );
        }

        $result = $this->twitters->insert($inserts);

        if ($result) {
            return redirect()
                ->route('sources.twitter.create')
                ->with('status', "Sources' Twitter updated!");
        }

        return redirect()
            ->route('sources.twitter.create')
            ->withErrors(["It was not possible to save Sources' Twitters, please try again!"]);
    }
}
