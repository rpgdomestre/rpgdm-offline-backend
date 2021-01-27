<?php

namespace App\Tasks;

use Closure;

class RemoveHiddenCollections
{
    public function handle($content, Closure $next)
    {
        $content = $content->reject->hidden;

        return $next($content);
    }
}
