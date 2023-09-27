@php
    $pagename = 'Clients';
    $pagecramp = 'Clients are the owners of the properties';
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
                <table class="table  table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Propeties</th>
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
                                <td>{{ $client->rooms()->count() }}</td>
                                <td>
                                    <div class="btn-group mb-2 mr-2">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">-</button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 43px, 0px);">
                                            <a class="dropdown-item " href="#!">Edit</a>
                                            <a class="dropdown-item text-danger" data-href="#">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
