<?php

namespace App\Tasks;

use Closure;

class EncodeCollectionsConfig
{
    public function handle($content, Closure $next)
    {
        $content = collect($content)
            ->map(function ($collection) {
                return (object) array_merge(
                    ['hidden' => false],
                    $collection
                );
            });

        return $next($content);
    }
}
