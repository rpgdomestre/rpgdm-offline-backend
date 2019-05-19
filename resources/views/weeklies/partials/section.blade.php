#### {{ $name  }}

@foreach ($links->sortBy('source') as $link)
- [{{ $link->name }}] <small>({{ $link->source }}@if($link->via), via {{ $link->via }}@endif)</small>
@endforeach

