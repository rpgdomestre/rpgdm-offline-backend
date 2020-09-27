<div class="w-1/2 mx-auto mb-20">
    @if (session('status'))
avelin       <div class="alert alert-success" style="position:absolute; bottom: 20px; right: 20px; z-index: 100">
            {!! session('status') !!}
        </div>
    @endif

    <div class="px-6 py-4">
        <div>
            <div>
                <div>
                    <form wire:submit.prevent="submit">
                        @csrf

                        <div>
                            <label for="edition"
                                   class="block mb-2 text-sm font-bold text-gray-700">{{ __('Edition') }}</label>

                            <div>
                                <input id="edition"
                                       type="number"
                                       class="block w-full px-4 py-3 mb-1 leading-tight text-gray-700 border rounded appearance-none"
                                       wire:model="edition">

                                @error('edition')
                                <p class="mb-2 text-xs italic text-red-500">{{ $message }}</p>
                            @else
                                <p class="mb-2 text-xs italic text-red-500">&nbsp;</p>
                            @enderror
                            </div>
                        </div>

                        <div>
                            <label for="link" class="block mb-2 text-sm font-bold text-gray-700">{{ __('Link Url') }}</label>

                            <div>
                                <input id="link"
                                       type="text"
                                       class="block w-full px-4 py-3 mb-1 leading-tight text-gray-700 border rounded appearance-none"
                                       name="link"
                                       wire:model="link">

                                @error('link')
                                <p class="mb-2 text-xs italic text-red-500">{{ $message }}</p>
                            @else
                                <p class="mb-2 text-xs italic text-red-500">&nbsp;</p>
                            @enderror
                            </div>
                        </div>

                        <div>
                            <label for="name"
                                   class="block mb-2 text-sm font-bold text-gray-700">{{ __('Link Name') }}</label>

                            <div>
                                <input id="name"
                                       type="text"
                                       class="block w-full px-4 py-3 mb-1 leading-tight text-gray-700 border rounded appearance-none"
                                       name="name"
                                       wire:model="name">

                                @error('name')
                                <p class="mb-2 text-xs italic text-red-500">{{ $message }}</p>
                            @else
                                <p class="mb-2 text-xs italic text-red-500">&nbsp;</p>
                            @enderror
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                                <label for="type"
                                       class="block mb-2 text-sm font-bold text-gray-700">{{ __('Link Type') }}</label>

                                <div class="mb-5">
                                    @foreach(['Nacional', 'Internacional', 'Geral'] as $option)
                                        <div>
                                            <input
                                                type="radio"
                                                name="type"
                                                id="radio-for-{{ $option }}"
                                                value="{{ Str::lower($option)  }}"
                                                {{ old('type') === $option ? 'checked' : '' }}
                                                wire:model="type">
                                            <label  for="radio-for-{{ $option }}">
                                                {{ $option }}
                                            </label>
                                        </div>
                                    @endforeach

                                    @error('type')
                                    <p class="mb-2 text-xs italic text-red-500">{{ $message }}</p>
                                @else
                                    <p class="mb-2 text-xs italic text-red-500">&nbsp;</p>
                                @enderror
                                </div>
                            </div>

                            <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                                <label for="section_id"
                                       class="block mb-2 text-sm font-bold text-gray-700">{{ __('Link Section') }}</label>

                                <div class="mb-5">
                                    @foreach($sections as $section)
                                        <div>
                                            <input
                                                type="radio"
                                                name="section_id"
                                                id="radio-for-{{ $section->name }}"
                                                value="{{ $section->id  }}"
                                                {{ (int) old('section_id') === $section->id ? 'checked' : '' }}
                                                wire:model="section_id">
                                                <label  for="radio-for-{{ $section->name }}">
                                                    {{ $section->name }}
                                                </label>
                                        </div>
                                    @endforeach

                                    @error('section_id')
                                    <p class="mb-2 text-xs italic text-red-500">{{ $message }}</p>
                                @else
                                    <p class="mb-2 text-xs italic text-red-500">&nbsp;</p>
                                @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="sourceName"
                                   class="block mb-2 text-sm font-bold text-gray-700">{{ __('Source') }}</label>

                            <div>
                                <input id="sourceName"
                                       type="text"
                                       class="block w-full px-4 py-3 mb-1 leading-tight text-gray-700 border rounded appearance-none"
                                       name="sourceName"
                                       wire:model="sourceName">

                                @error('source')
                                <p class="mb-2 text-xs italic text-red-500">{{ $message }}</p>
                            @else
                                <p class="mb-2 text-xs italic text-red-500">&nbsp;</p>
                            @enderror
                            </div>
                        </div>

                        <div>
                            <label for="via"
                                   class="block mb-2 text-sm font-bold text-gray-700">{{ __('Via') }}</label>

                            <div>
                                <input id="via"
                                       type="text"
                                       class="block w-full px-4 py-3 mb-1 leading-tight text-gray-700 border rounded appearance-none"
                                       name="via"
                                       wire:model="via">

                                @error('via')
                                <p class="mb-2 text-xs italic text-red-500">{{ $message }}</p>
                            @else
                                <p class="mb-2 text-xs italic text-red-500">&nbsp;</p>
                            @enderror
                            </div>
                        </div>

                        <div class="flex justify-end mb-0 ">
                            <button type="submit" class="px-2 py-1 mr-5 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                {{ __('Create Link') }}
                            </button>
                            <a href="{{ route('weeklies.edit', ['weekly' => $edition ]) }}" class="px-2 py-1 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
