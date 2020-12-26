<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Collections') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="pb-12">
            @if (session('status'))
                <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                    <p class="font-bold">Success</p>
                    <p class="text-sm">{!! session('status') !!}</p>
                </div>
            @endif
            </div>

            <div class="flex justify-end pb-6">
                <form action="{{ route('collections.publish') }}" method="POST">
                    @csrf
                    @method('POST')
                    <button class="inline-block px-2 py-1 font-bold text-white bg-red-500 rounded hover:bg-red-700">Publish all</button>
                </form>
            </div>
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <table class="w-full border-collapse table-auto">
                    <thead>
                        <tr class="text-sm font-medium text-left text-gray-700 rounded-lg">
                            <th class="px-6 py-4 bg-gray-200 ">Title</th>
                            <th class="px-6 py-4 bg-gray-200 "># Entries</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($collections as $collection => $metadata)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ Str::title($collection) }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $metadata['entries'] }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
