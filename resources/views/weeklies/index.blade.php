@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Edition</th>
                                <th>Released at</th>
                                <th># of Links</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($weeklies as $weekly)
                        <tr>
                            <td>
                                <a href="{{ route('weeklies.edit', ['weekly' => $weekly]) }}" class="">
                                    {{ $weekly->edition }}
                                </a>
                            </td>
                            <td>{{ $weekly->released_at }}</td>
                            <td>{{ $weekly->numberOfLinks($weekly) }}</td>
                            <td>
                                <a href="{{ route('weeklies.markdown', ['weekly' => $weekly]) }}"
                                   class="btn btn-sm btn-primary">Generate MD</a>
                                <a href="{{ route('weeklies.twitter', ['weekly' => $weekly]) }}"
                                   class="btn btn-sm btn-secondary">Generate TY</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="justify-content-center">
                        {{ $weeklies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
