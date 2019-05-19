### {{ $name }}

@foreach ($sections->reverse() as $sectionName => $links)
@include('weeklies.partials.section', ['links' => $links, 'name' => $sectionName])
@endforeach
