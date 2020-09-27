<?php declare(strict_types=1);

namespace App\View\Composers;

use App\Models\Section;
use Illuminate\View\View;

class SectionsComposer
{
    private Section $section;

    public function __construct(Section $section)
    {
        $this->section = $section;
    }

    public function compose(View $view)
    {
        $sections = $this->section->all(['id', 'name']);
        $view->with('sections', $sections);
    }
}
