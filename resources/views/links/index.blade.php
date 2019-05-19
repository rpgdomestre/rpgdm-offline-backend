@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
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
    </div>
@endsection
