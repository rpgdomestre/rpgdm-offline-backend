<?php

namespace App\Tasks;

use Closure;

class PaginateCollectionsEntries
{
    public function handle($content, Closure $next)
    {
        $metadata = null;

        $content = $content->map(
            function ($collection) use ($metadata) {
                if ($collection->isEmpty()) {
                    return $collection;
                }

                $metadata ??= $collection->first()['collection'];

                return $collection->chunk($metadata->chunk);
            }
        );

        return $next($content);
    }
}
