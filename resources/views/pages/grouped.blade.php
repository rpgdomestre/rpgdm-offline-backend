<x-weekly-published>
    <x-slot name="metaTitle">yyy</x-slot>
    <x-slot name="metaDescription">xxx</x-slot>
    <div class="prose prose-{{ $color ?? 'black' }} prose-sm sm:prose lg:prose-lg xl:prose-2xl mx-auto py-20">
        @foreach ($items as $item)
            <h2>{{ $item['title'] }}</h2>
        @endforeach;
    </div>
</x-weekly-published>
