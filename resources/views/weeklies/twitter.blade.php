@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Twitter users mentioned') }}</div>

                    <div class="card-body">
                        <div class="form-group">
                            <textarea
                                class="form-control"
                                id="twitters"
                                rows="10">Obrigado/Thanks/Gracias/Merci/Grazi/Dankeschön: @foreach ($all as $link){{ $link->twitter->twitter }} @endforeach</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
