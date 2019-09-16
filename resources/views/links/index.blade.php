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
                                <th>Date</th>
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
                            <td>{{ $link->created_at }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="justify-content-center">
                        {{ $links->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
