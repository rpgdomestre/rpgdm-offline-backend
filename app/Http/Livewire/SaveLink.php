<?php

namespace App\Http\Livewire;

use App\Requests\StoreLinks;
use App\Models\Link;
use Livewire\Component;

class SaveLink extends Component
{
    // Link data
    public $edition;
    public $link;
    public $name;
    public $type;
    public $section_id;
    public $sourceName;
    public $via;

    public function updated($field)
    {
        $this->validateOnly($field, [
            'edition' => 'required|exists:weeklies,id',
            'link' => 'required|url|unique:links',
        ]);
    }

    public function submit()
    {
        $rules = (new StoreLinks)->rules();
        $this->validate($rules);

        $link = Link::firstOrCreate([
            'edition' => $this->edition,
            'link' => $this->link,
            'name' => $this->name,
            'type' => $this->type,
            'section_id' => $this->section_id,
            'source' => $this->sourceName,
            'via' => $this->via,
        ]);

        $editLinkRoute = route('links.edit', ['link' => $link]);

        session()->flash(
            'status',
            "Link <a href='{$editLinkRoute}'>{$link->name}</a> created!"
        );

        $edition = $this->edition;

        // cleans up form
        $this->reset();

        $this->edition = $edition;
    }

    public function mount(int $edition, array $linkData)
    {
        $this->edition = old('edition', $edition);
        $this->link = old('link', $linkData['link'] ?? '');
        $this->name = old('name', $linkData['name'] ?? '');
        $this->type = old('type', $linkData['type'] ?? '');
        $this->section_id = old('section_id', $linkData['section_id'] ?? 0);
        $this->sourceName = old('sourceName', $linkData['sourceName'] ?? '');
        $this->via = old('via', $linkData['via'] ?? '');
    }

    public function render()
    {
        return view('livewire.save-link');
    }
}
