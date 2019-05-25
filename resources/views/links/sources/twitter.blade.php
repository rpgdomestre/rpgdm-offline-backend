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
                    <div class="card-header">{{ __('Add Sources\' Twitter') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('sources.twitter.store') }}">
                            @csrf

                            @foreach ($sources as $source)
                                <div class="form-group row">
                                    <label for="source{{$source->id}}"
                                           class="col-md-4 col-form-label text-md-right">{{ $source->source }}</label>
                                    <input type="hidden" name="source[]" value="{{ $source->source }}">

                                    <div class="col-md-6">
                                        <input id="source{{$source->id}}" type="text"
                                               class="form-control"
                                               name="twitter[]"
                                               value="{{ $source->twitter }}" autofocus>
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save Twitters') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
