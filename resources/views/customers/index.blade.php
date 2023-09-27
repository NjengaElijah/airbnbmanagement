@php
    $pagename = 'Customers';
    $pagecramp = 'View and manage all customers from here !';
@endphp
@extends('partials.main')

@section('content')
    <div class="  ">
        {{-- <button is_modal="1" data-href="{{ route('customer_add') }}" class="btn btn-danger btn-sm">Add customer</button> --}}
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
                            <th>Bookings</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $index => $customer)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td> <a href="{{route('customer_bookings',$customer->id)}}">{{ $customer->bookings()->count() }}</a> </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
