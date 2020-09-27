<?php

namespace App\Http\Livewire;

use App\Models\Link;
use App\Requests\UpdateLinks;
use Livewire\Component;

class UpdateLink extends Component
{
    // Link data
    public $unique_id;
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
            'id' => "required|exists:links,id,{$this->unique_id}",
            'edition' => 'required|exists:weeklies,id',
            'link' => 'required|url|unique:links',
        ]);
    }

    public function submit()
    {
        $rules = (new UpdateLinks())->rules();
        $this->validate($rules);

        $link = Link::where('id', $this->unique_id)
            ->update([
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
            "Link <em><a href='{$editLinkRoute}'>{$this->name}</a></em> updated!"
        );

        return redirect()->route('weeklies.edit', ['weekly' => $this->edition]);
    }

    public function mount(int $edition, array $linkData)
    {
        $this->unique_id = $linkData['id'];
        $this->edition = old('edition', $edition);
        $this->link = old('link', $linkData['link'] ?? '');
        $this->name = old('name', $linkData['name'] ?? '');
        $this->type = old('type', $linkData['type'] ?? '');
        $this->section_id = old('section_id', $linkData['section_id'] ?? 0);
        $this->sourceName = old('sourceName', $linkData['source'] ?? '');
        $this->via = old('via', $linkData['via'] ?? '');
        //ddd($this);
    }

    public function render()
    {
        return view('livewire.update-link');
    }
}
