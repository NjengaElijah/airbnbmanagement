@php
    $pagename = 'Bookings';
    $pagecramp = 'View and manage bookings here !';
@endphp
@extends('partials.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>View & Manage Bookings</h5>
        </div>
        <div class="card-body">
            <table class="table table-sm table-striped">
                <thead>
                    <th>Id</th>
                    <th>Customer</th>
                    <th>Room</th>
                    <th>Adults</th>
                    <th>Children</th>
                    <th>Price Per Night</th>
                    <th>Start</th>
                    <th>Days</th>
                    <th>Client</th>
                    <th> </th>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->room->name }}</td>
                            <td>{{ $booking->no_adults }}</td>
                            <td>{{ $booking->no_children }}</td>
                            <td>{{ $booking->price_per_night }}</td>
                            <td>
                                <p>{{ $booking->start_date }}</p>
                                <p>{{ $booking->end_date }}</p>
                            </td>
                            <td>{{$booking->nights()}} </td>
                            <td>{{ $booking->room->client->names() }}</td>
                            <td>
                                <button class="btn btn-sm btn-info"> edit </button>
                                <button class="btn btn-sm btn-success"> approve </button>
                                <button class="btn btn-sm btn-danger"> cancel </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
