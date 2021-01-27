<?php

namespace App\Tasks;

use Closure;

class GenerateCollectionsReport
{
    public function handle($content, Closure $next)
    {
        $content = $content->map(function ($collection) {
            return $collection->isEmpty()
                ? __('rpgdm.collections.status.empty')
                : __('rpgdm.collections.status.published');
        });

        return $next($content);
    }
}
