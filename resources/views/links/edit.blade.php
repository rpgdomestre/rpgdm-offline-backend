@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success">
                        {!! session('status') !!}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">{{ __('Edit Link') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('links.update', ['link' => $link]) }}">
                            @method('PUT')
                            @csrf

                            <div class="form-group row">
                                <label for="link" class="col-md-4 col-form-label text-md-right">{{ __('Link Url') }}</label>

                                <div class="col-md-6">
                                    <input id="link" type="text"
                                           class="form-control @error('link') is-invalid @enderror" name="link"
                                           value="{{ $link->link }}" required autofocus>

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
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ $link->name }}" required>

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
                                    <select class="form-control" name="type" id="type">
                                        <option @if($link->type === 'Nacional') selected @endif>Nacional</option>
                                        <option @if($link->type === 'Internacional') selected @endif>Internacional</option>
                                        <option @if($link->type === 'Geral') selected @endif>Geral</option>
                                    </select>

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
                                    <select class="form-control" name="section_id" id="section_id">
                                        @foreach($sections as $section)
                                        <option
                                            @if($link->section->id === $section->id) selected @endif
                                            value="{{ $section->id }}">{{ $section->name }}
                                        </option>
                                        @endforeach
                                    </select>

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
                                    <input id="source" type="text"
                                           class="form-control @error('source') is-invalid @enderror" name="source"
                                           value="{{ $link->source }}" required>

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
                                    <input id="via" type="text"
                                           class="form-control @error('via') is-invalid @enderror" name="via"
                                           value="{{ $link->via ?? '' }}">

                                    @error('via')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Link') }}
                                    </button>
                                    <a href="{{ route('links.index') }}" class="btn btn-secondary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
