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
                    <div class="card-header">{{ __('Edit Weekly') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('weeklies.update', ['weekly' => $weekly]) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="edition"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Edition') }}</label>

                                <div class="col-md-6">
                                    <input id="edition" type="number"
                                           class="form-control @error('edition') is-invalid @enderror" name="edition"
                                           value="{{ old('edition') ?: $weekly->edition }}" required>

                                    @error('edition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="released_at"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Release Date') }}</label>

                                <div class="col-md-6">
                                    <input id="released_at" type="date"
                                           class="form-control @error('released_at') is-invalid @enderror" name="released_at"
                                           value="{{ old('released_at') ?: $weekly->released_at }}" required>

                                    @error('released_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea class="form-control @error('description') is-invalid @enderror"
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

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Weekly') }}
                                    </button>
                                    <a href="{{ route('weeklies.index') }}" class="btn btn-secondary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <h3 class="mt-5">{{ count($links) }} links on this Weekly</h3>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Section</th>
                        <th>Source</th>
                        <th>Via</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($links as $link)
                        <tr>
                            <td>{{ $link->id  }}</td>
                            <td>
                                <a href="{{ route('links.edit', ['link' => $link]) }}" class="">
                                    {{ $link->name }}
                                </a>
                            </td>
                            <td>{{ $link->type }}</td>
                            <td>{{ $link->section->name }}</td>
                            <td>{{ $link->source }}</td>
                            <td>{{ $link->via ?? '' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
