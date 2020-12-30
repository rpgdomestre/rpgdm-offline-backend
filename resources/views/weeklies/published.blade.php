<x-weekly-published>
    <x-slot name="metaTitle">{{ $title ?? "Weekly #{$number}" }}</x-slot>
    <x-slot name="metaDescription">{{ $description }}</x-slot>
    <div class="prose prose-blue prose-sm sm:prose lg:prose-lg xl:prose-2xl mx-auto py-20">
    <h6 class="sm:text-lg sm:leading-snug font-semibold tracking-wide uppercase text-blue-600 mb-3">Weekly</h6>
        <h1>#{{ $number }}</h1>
        {!! $content !!}
    </div>
</x-weekly-published>
