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

                    <div class="col-md-12">
                        <table class="table table-sm table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Source Name</th>
                                <th>Twitter Handle</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($sources as $source)
                                <tr class="{{ $source->twitter ? '' : 'bg-danger' }}">
                                    <td>
                                        {{$source->id}}
                                        <input type="hidden" name="source[]" value="{{ $source->source }}">
                                    </td>
                                    <td>{{ $source->source }}</td>
                                    <td>
                                        <input id="source{{$source->id}}"
                                               type="text"
                                               name="twitter[]"
                                               value="{{ $source->twitter }}"
                                               style="width: 100%">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Save Twitters') }}
                                    </button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
