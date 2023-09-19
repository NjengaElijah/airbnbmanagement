@php
    $pagename = 'Apartments (Create and manage your parents)';
    $pagecramp = 'Apartments';
@endphp
@extends('partials.main')

@section('content')
    <div class="  ">
        <button is_modal="1" data-href="{{ route('apartment_add') }}" class="btn btn-danger btn-sm">Add Apartment</button>
        <div class="card mt-2">
            <div class="card-header">
                <div class="col-3">

                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Names</th>
                            {{-- <th>Description</th> --}}
                            <th>Location</th>
                            <th>Rooms</th>
                            <th>Client</th>
                            <th>Date Added</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartments as $index => $apartment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $apartment->name }}</td>
                                {{-- <td>{{ $apartment->description }}</td> --}}
                                <td>{{ $apartment->location }}</td>
                                <td></td>
                                <td> <a href="#">{{ $apartment->client->names() }}</a> </td>
                                <td>{{ $apartment->created_at }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
