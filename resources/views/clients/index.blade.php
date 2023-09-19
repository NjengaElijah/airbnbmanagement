@php
    $pagename = 'Clients';
    $pagecramp = 'Clients';
@endphp
@extends('partials.main')

@section('content')
    <div class="  ">
        <button is_modal="1" data-href="{{ route('client_add') }}" class="btn btn-danger btn-sm">Add Client</button>
        <div class="card mt-2">
            <div class="card-header">
                <div class="col-3">

                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Apartments</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $index => $client)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $client->names() }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>{{ $client->apartments()->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
