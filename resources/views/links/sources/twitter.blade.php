@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">
                        {!! session('status') !!}
                    </div>
                @endif

                <h1>{{ __('Add Sources\' Twitter') }}</h1>

                <form method="POST"
                      class="row"
                      action="{{ route('sources.twitter.store') }}">
                    @csrf

                    <div class="col-md-12 mb-4">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Save Twitters') }}
                        </button>
                    </div>

                    @foreach ($sources as $source)
                        <div class="col-md-3 mb-4 {{ $source->hide ? 'd-none' : '' }}">
                            <div class="card {{ $source->twitter ?? 'bg-danger text-white' }}">
                                <input type="hidden" name="source[]" value="{{ $source->source }}">

                                <div class="card-header">
                                    <label for="source{{$source->id}}"
                                           class="m-0">{{ $source->source }}</label>
                                </div>

                                <div class="card-body">
                                    <input id="source{{$source->id}}"
                                           type="text"
                                           class="form-control mb-1"
                                           name="twitter[]"
                                           value="{{ $source->twitter }}">

                                    <div>
                                        <input type="checkbox"
                                               name="hides[{{ $source->source }}]"
                                               {{ $source->hide ? 'checked' : '' }}
                                               value="true"
                                               id="should-hide">
                                        <label class="form-check-label" for="should-hide">
                                            Should hide?
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-12 mb-4">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Save Twitters') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
