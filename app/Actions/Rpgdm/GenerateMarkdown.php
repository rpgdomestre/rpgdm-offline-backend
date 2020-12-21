<?php

namespace App\Actions\Rpgdm;

use App\Models\Weekly;

class GenerateMarkdown
{
    public function execute(Weekly $weekly)
    {
        $fetched = $weekly->fetchLinks($weekly);
        $allLinks = $fetched['all'];
        $groups = $fetched['groups'];

        return view(
            'weeklies.markdown',
            compact('weekly', 'allLinks', 'groups')
        );
    }
}
