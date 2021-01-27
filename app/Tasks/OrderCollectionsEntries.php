<?php

namespace App\Tasks;

use Closure;

class OrderCollectionsEntries
{
    public function handle($content, Closure $next)
    {
        $content = $content->map->sortByDesc('time');

        return $next($content);
    }
}
