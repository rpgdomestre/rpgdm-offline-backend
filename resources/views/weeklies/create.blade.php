<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="{{route('weeklies.index')}}">{{ __('Weeklies') }}</a> &raquo;
            {{ __('Create Weekly') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            @if (session('status'))
                <div class="px-4 py-3 text-blue-700 bg-blue-100 border-t border-b border-blue-500" role="alert">
                    <p class="font-bold">Weekly successfully updated</p>
                    <p class="text-sm">{!! session('status') !!}</p>
                </div>
            @endif
            </div>

            <div class="flex justify-between bg-white">
                <div class="w-1/2 mx-auto mb-20">
                    <div class="px-6 py-4">
                        <form method="POST" action="{{ route('weeklies.store') }}">
                            @csrf

                            <div class="flex flex-wrap mb-5 -mx-3">
                                <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                                    <label for="edition"
                                           class="block mb-2 text-sm font-bold text-gray-700">
                                        {{ __('Edition') }}
                                    </label>

                                    <div class="col-md-6">
                                        <input id="edition"
                                               type="number"
                                               class="block w-full px-4 py-3 leading-tight text-gray-700 border rounded appearance-none"
                                               name="edition"
                                               value="{{ old('edition') ?: $newWeekly }}" required>

                                        @error('edition')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>

                                <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                                    <label for="released_at"
                                           class="block mb-2 text-sm font-bold text-gray-700">
                                        {{ __('Release Date') }}
                                    </label>

                                    <div class="col-md-6">
                                        <input id="released_at"
                                               type="date"
                                               class="block w-full px-4 py-3 leading-tight text-gray-700 border rounded appearance-none"
                                               name="released_at"
                                               value="{{ $today ?: old('released_at') }}" required>

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
                                       class="block mb-2 text-sm font-bold text-gray-700">
                                    {{ __('Description') }}
                                </label>

                                <div class="col-md-6">
                                    <textarea class="block w-full px-4 py-3 mb-5 leading-tight text-gray-700 border rounded appearance-none"
                                              rows="10"
                                              name="description"
                                              id="description">{{ old('description') }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="px-2 py-1 mr-5 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                    {{ __('Update Weekly') }}
                                </button>
                                <a href="{{ route('weeklies.index') }}" class="px-2 py-1 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
