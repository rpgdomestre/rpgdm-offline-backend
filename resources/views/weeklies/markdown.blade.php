{{ $weekly->description  }}

@foreach ($groups as $name => $sections)
@includeWhen($sections->count(), 'weeklies.partials.groups', ['sections' => $sections, 'name' => $name])
@endforeach

@include('weeklies.partials.references', ['links' => $allLinks])
