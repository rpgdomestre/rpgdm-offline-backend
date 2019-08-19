@include(
    'weeklies.partials.frontmatter',
    [
        'edition' => $weekly->edition,
        'released_at' => $weekly->released_at,
        'description' => $weekly->description
    ]
)

{{ $weekly->description  }}

@foreach ($groups as $name => $sections)
@includeWhen(
    $sections->count(),
    'weeklies.partials.groups',
    [
        'sections' => $sections,
        'name' => $name
    ]
)
@endforeach

@include('weeklies.partials.references', ['links' => $allLinks])
