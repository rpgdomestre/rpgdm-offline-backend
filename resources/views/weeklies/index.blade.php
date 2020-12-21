<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Weeklies') }}
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
                <a href="{{ route('weeklies.create') }}" class="inline-block px-2 py-1 mr-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Create Weekly</a>
                <form action="{{ route('weeklies.build') }}" method="POST">
                    @csrf
                    @method('POST')
                    <button class="inline-block px-2 py-1 mr-2 font-bold text-white bg-yellow-500 rounded hover:bg-yellow-700">Build all</button>
                </form>
                <form action="{{ route('weeklies.publish') }}" method="POST">
                    @csrf
                    @method('POST')
                    <button class="inline-block px-2 py-1 font-bold text-white bg-red-500 rounded hover:bg-red-700">Publish all</button>
                </form>
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
                        <td class="flex px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <a href="{{ route('weeklies.markdown', ['weekly' => $weekly]) }}"
                            class="px-2 py-1 mr-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Markdown</a>
                            <a href="{{ route('weeklies.twitter', ['weekly' => $weekly]) }}"
                            class="px-2 py-1 mr-2 font-bold text-white bg-purple-500 rounded hover:bg-purple-700">Thank You</a>
                            <form action="{{ route('weeklies.build.single', ['weekly' => $weekly]) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button class="inline-block px-2 py-1 mr-2 font-bold text-white bg-yellow-500 rounded hover:bg-yellow-700">Build</button>
                            </form>
                            <form action="{{ route('weeklies.publish.single', ['weekly' => $weekly]) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button class="inline-block px-2 py-1 font-bold text-white bg-red-500 rounded hover:bg-red-700">Publish</button>
                            </form>
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
