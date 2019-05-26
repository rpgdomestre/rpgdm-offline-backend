<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSourceTwitter;
use App\SourceTwitter;

class SourceTwitterStore extends Controller
{
    /**
     * @var \App\SourceTwitter
     */
    private $twitters;

    /**
     * SourceTwitterStore constructor.
     *
     * @param \App\SourceTwitter $twitters
     */
    public function __construct(
        SourceTwitter $twitters
    ) {
        $this->twitters = $twitters;
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
        $inserts = $this->twitters->prepareMultipleInsertValues(
            $request->get('source'),
            $request->get('twitter'),
            (array) $request->get('hides')
        );

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
