<?php

namespace App\Tasks;

use App;
use Closure;

class RemoveCollectionsDraftEntries
{
    public function handle($content, Closure $next)
    {
        $content = $content->map->reject(function ($entry) {
            if (App::environment(['local', 'staging', 'stage'])) {
                return false;
            }

            return $entry['meta']['draft'] ?? false;
        });


        return $next($content);
    }
}
