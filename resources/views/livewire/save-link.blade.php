<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success">
                    {!! session('status') !!}
                </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Create Link') }}</div>

                <div class="card-body">
                    <form wire:submit.prevent="submit">
                        @csrf

                        <div class="form-group row">
                            <label for="edition"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Edition') }}</label>

                            <div class="col-md-6">
                                <input id="edition"
                                       type="number"
                                       class="form-control @error('edition') is-invalid @enderror"
                                       wire:model="edition">

                                @error('edition')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="link" class="col-md-4 col-form-label text-md-right">{{ __('Link Url') }}</label>

                            <div class="col-md-6">
                                <input id="link"
                                       type="text"
                                       class="form-control @error('link') is-invalid @enderror"
                                       name="link"
                                       wire:model="link">

                                @error('link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Link Name') }}</label>

                            <div class="col-md-6">
                                <input id="name"
                                       type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       wire:model="name">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Link Type') }}</label>

                            <div class="col-md-6">
                                @foreach(['Nacional', 'Internacional', 'Geral'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="type"
                                               id="radio-for-{{ $option }}"
                                               value="{{ $option  }}"
                                               {{ old('type') === $option ? 'checked' : '' }}
                                               wire:model="type">
                                        <label class="form-check-label" for="radio-for-{{ $option }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach

                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="section_id"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Link Section') }}</label>

                            <div class="col-md-6">
                                @foreach($sections as $section)
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="section_id"
                                               id="radio-for-{{ $section->name }}"
                                               value="{{ $section->id  }}"
                                               {{ (int) old('section_id') === $section->id ? 'checked' : '' }}
                                               wire:model="section_id">
                                            <label class="form-check-label" for="radio-for-{{ $section->name }}">
                                                {{ $section->name }}
                                            </label>
                                    </div>
                                @endforeach

                                @error('section_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="source"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Source') }}</label>

                            <div class="col-md-6">
                                <input id="source"
                                       type="text"
                                       class="form-control @error('source') is-invalid @enderror"
                                       name="source"
                                       wire:model="source">

                                @error('source')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="via"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Via') }}</label>

                            <div class="col-md-6">
                                <input id="via"
                                       type="text"
                                       class="form-control @error('via') is-invalid @enderror"
                                       name="via"
                                       wire:model="via">

                                @error('via')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="mb-0 form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
