<?php declare(strict_types=1);

namespace App\View\Composers;

use App\Models\Weekly;
use Illuminate\View\View;

class WeeklyNumberComposer
{
    private Weekly $weekly;

    public function __construct(Weekly $weekly)
    {
       $this->weekly = $weekly;
    }

    public function compose(View $view)
    {
        $weeklyNumber = $this->weekly->latestUpdatedWeekly();
        $view->with('weeklyNumber', $weeklyNumber);
    }
}
