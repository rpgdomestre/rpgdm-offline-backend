<?php

namespace App\Http\Livewire;

use App\Link;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;

class SaveLink extends Component
{
    // rendering data
    public $sections;

    // Link data
    public $edition;
    public $link;
    public $name;
    public $type;
    public $section_id;
    public $source;
    public $via;

    public function updated($field)
    {
        $this->validateOnly($field, [
            'edition' => 'required|exists:weeklies,id',
            'link' => 'required|url|unique:links',
            'via' => 'required_if:section_id,5',
        ]);
    }

    public function submit()
    {
        $this->validate([
            'link' => 'required|url|unique:links',
            'name' => 'required',
            'type' => [
                'required',
                Rule::in(['nacional', 'internacional', 'geral']),
            ],
            'section_id' => 'required|exists:sections,id',
            'source' => 'required',
            'via' => 'required_if:section_id,5',
            'edition' => 'required|exists:weeklies,id',
        ]);

        Link::firstOrCreate([
            'edition' => $this->edition
        ]);
    }

    public function mount($sections)
    {
        $this->sections = $sections;
    }

    public function render()
    {
        return view('livewire.save-link');
    }
}
