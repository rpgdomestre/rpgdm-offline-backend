@if ($metadata['type'] === 'hidden')
    <input type="hidden" name="{{ $field }}" value="{{ $metadata['value'] ?? '' }}" />
@else
<div class="w-full px-3 mb-6">
    <label for="{{ $field }}" class="block mb-2 text-sm font-bold text-gray-700">
        {{ Str::title($field) }}
    </label>

    @if ($metadata['type'] === 'text')
    <div class="col-md-6">
        <input type="text"
                name="{{ $field }}"
                value="{{ $metadata['value'] ?? $entry->metadata[$field] ?? ''  }}"
                class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 leading-tight"
                id="{{ $field }}"
                required />

        @error($field)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    @endif

    @if ($metadata['type'] === 'textarea')
    <div>
        <textarea
            name="{{ $field }}"
            class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 leading-tight mb-5"
            id="{{ $field }}"
            cols="30"
            rows="10"
        >{{ $metadata['value'] ?? ''}}</textarea>
    </div>
    @endif
    </div>
@endif
