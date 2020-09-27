<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Weeklies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-end pb-6">
                <a href="{{ route('weeklies.create') }}" class="inline-block px-2 py-1 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Create Weekly</a>
            </div>
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <table class="w-full border-collapse table-auto">
                    <thead>
                        <tr class="text-sm font-medium text-left text-gray-700 rounded-lg">
                            <th class="px-6 py-4 bg-gray-200 ">Edition</th>
                            <th class="px-6 py-4 bg-gray-200 ">Released at</th>
                            <th class="px-6 py-4 bg-gray-200 "># of Links</th>
                            <th class="px-6 py-4 bg-gray-200 ">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($weeklies as $weekly)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <a href="{{ route('weeklies.edit', ['weekly' => $weekly]) }}" class="">
                                {{ $weekly->edition }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $weekly->released_at }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $weekly->numberOfLinks($weekly) }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <a href="{{ route('weeklies.markdown', ['weekly' => $weekly]) }}"
                            class="px-2 py-1 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Generate MD</a>
                            <a href="{{ route('weeklies.twitter', ['weekly' => $weekly]) }}"
                            class="px-2 py-1 font-bold text-white bg-purple-500 rounded hover:bg-purple-700">Generate TY</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="px-6 py-4 text-sm font-medium text-left text-gray-700 bg-gray-200 rounded-b-lg">
                    {{ $weeklies->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
