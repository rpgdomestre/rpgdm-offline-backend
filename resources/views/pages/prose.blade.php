<x-weekly-published>
    <x-slot name="metaTitle">{{ $title }}</x-slot>
    <x-slot name="metaDescription">{{ $description }}</x-slot>
    <div class="prose prose-{{ $color }} prose-sm sm:prose lg:prose-lg xl:prose-2xl mx-auto py-20">
        @if ($parent !== '/')
        <h6 class="sm:text-lg sm:leading-snug font-semibold tracking-wide uppercase mb-3">{{ $parent }}</h6>
        @endif
        <h1>{{ $title }}</h1>
        {!! $content !!}
    </div>
</x-weekly-published>
