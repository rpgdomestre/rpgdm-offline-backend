<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('weeklies.index')}}">{{ __('Weeklies') }}</a> &raquo;
            {{ __("Edit Weekly #{$weekly->id}") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @if (session('status'))
                <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                    <p class="font-bold">Weekly successfully updated</p>
                    <p class="text-sm">{!! session('status') !!}</p>
                </div>
            @endif

            <div class="flex justify-between bg-gray-200">
                <a class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold px-6 py-4 rounded-t-l"
                    href="{{ route('weeklies.edit', ['weekly' => $weekly->id - 1]) }}"
                    aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span> Previous
                </a>
                <a class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold px-6 py-4 rounded-t-r"
                    href="{{ route('weeklies.edit', ['weekly' => $weekly->id + 1]) }}"
                    aria-label="NExt">
                    Next <span aria-hidden="true">&raquo;</span>
                </a>
            </div>

            <div class="w-1/2 mx-auto mb-20">
                <div class="px-6 py-4">
                    <form method="POST" action="{{ route('weeklies.update', ['weekly' => $weekly]) }}">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-wrap -mx-3 mb-5">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label for="edition"
                                    class="block text-gray-700 text-sm font-bold mb-2">
                                    {{ __('Edition') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="edition" type="number"
                                            class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 leading-tight"
                                            name="edition"
                                            value="{{ old('edition') ?: $weekly->edition }}" required>

                                    @error('edition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label for="released_at"
                                        class="block text-gray-700 text-sm font-bold mb-2">
                                    {{ __('Release Date') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="released_at" type="date"
                                        class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 leading-tight"
                                        name="released_at"
                                        value="{{ old('released_at') ?: $weekly->released_at }}" required>

                                    @error('released_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description"
                                    class="block text-gray-700 text-sm font-bold mb-2">
                                {{ __('Description') }}
                            </label>

                            <div class="col-md-6">
                                <textarea class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 leading-tight mb-5"
                                    rows="10"
                                    name="description"
                                    id="description">{{ old('description') ?: $weekly->description }}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-5">
                                {{ __('Update Weekly') }}
                            </button>
                            <a href="{{ route('weeklies.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>

                <h3 class="flex justify-between px-6 py-4 ">
                    <span class="font-bold">{{ count($links) }} links on this Weekly</span>
                    <a href="{{ route('links.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Create link</a>
                </h3>
                <table class="table-auto border-collapse w-full">
                    <thead>
                    <tr class="rounded-lg text-sm font-medium text-gray-700 text-left">
                        <th class="px-6 py-4 bg-gray-200 ">Id</th>
                        <th class="px-6 py-4 bg-gray-200 ">Title</th>
                        <th class="px-6 py-4 bg-gray-200 ">Type</th>
                        <th class="px-6 py-4 bg-gray-200 ">Section</th>
                        <th class="px-6 py-4 bg-gray-200 ">Source</th>
                        <th class="px-6 py-4 bg-gray-200 ">Via</th>
                        <th class="px-6 py-4 bg-gray-200 ">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($links as $link)
                    <tr>
                        <td class="px-6 py-4 border-b border-gray-200">{{ $link->id  }}</td>
                        <td class="px-6 py-4 border-b border-gray-200">
                            <a href="{{ route('links.edit', ['link' => $link]) }}" class="">
                                {{ $link->name }}
                            </a>
                        </td>
                        <td class="px-6 py-4 border-b border-gray-200">{{ $link->type }}</td>
                        <td class="px-6 py-4 border-b border-gray-200">{{ $link->section->name }}</td>
                        <td class="px-6 py-4 border-b border-gray-200">{{ $link->source }}</td>
                        <td class="px-6 py-4 border-b border-gray-200">{{ $link->via ?? '' }}</td>
                        <td class="px-6 py-4 border-b border-gray-200">
                            <form action="{{ route('links.destroy', ['link' => $link]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="edition" value="{{ $weekly->edition }}"/>
                                <input type="hidden" name="id" value="{{ $link->id }}"/>
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
