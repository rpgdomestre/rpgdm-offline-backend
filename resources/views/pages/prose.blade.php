<x-weekly-published>
    <div class="prose prose-{{ $color }} prose-sm sm:prose lg:prose-lg xl:prose-2xl mx-auto py-20">
        @if ($parent !== '/')
        <h6 class="sm:text-lg sm:leading-snug font-semibold tracking-wide uppercase mb-3">{{ $parent }}</h6>
        @else
        <h6 class="sm:text-lg sm:leading-snug font-semibold tracking-wide uppercase mb-3">
            <span class="sm:text-lg sm:leading-snug font-semibold tracking-wide uppercase mb-3 text-transparent bg-gradient-to-r bg-clip-text from-blue-600 via-pink-600 to-yellow-300">RPG do Mestre</span>
        </h6>
        @endif
        <h1>{{ $title }}</h1>
        {!! $content !!}
    </div>
</x-weekly-published>
