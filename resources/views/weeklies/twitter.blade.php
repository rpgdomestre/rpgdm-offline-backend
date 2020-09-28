<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('weeklies.index')}}">{{ __('Weeklies') }}</a> &raquo;
            {{ __('Twitter users mentioned') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between bg-white">
                <textarea class="block w-full px-4 py-3 m-5 leading-tight text-gray-700 border rounded appearance-none"
                          rows="10"
                          name="description"
                          id="twitters"
                          rows="10">Obrigado/Thanks/Gracias/Merci/Grazi/Dankeschön: @foreach ($all as $link){{ $link->twitter->twitter }} @endforeach</textarea>
            </div>
        </div>
    </div>
</x-app-layout>
