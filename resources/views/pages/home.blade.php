<x-homepage>
    <x-slot name="metaTitle">{{ $title }}</x-slot>
    <x-slot name="metaDescription">{{ $description ?? '' }}</x-slot>
    {!! $content !!}
</x-homepage>
