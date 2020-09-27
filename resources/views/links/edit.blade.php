<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="{{route('weeklies.index')}}">{{ __('Weeklies') }}</a> &raquo;
            <a href="{{route('weeklies.edit', ['weekly' => $link->edition])}}">{{ __("Edit Weekly #{$link->edition}") }}</a> &raquo;
            {{ __('Edit Link') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <livewire:update-link :edition="$link->edition" :link-data="$link->toArray()" />
            </div>
        </div>
    </div>
</x-app-layout>
