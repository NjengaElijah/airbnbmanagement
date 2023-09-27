@php
    $pagename = 'Properties';
    $pagecramp = 'Create and manage room properties/rooms here !';
@endphp
@extends('partials.main')

@section('content')
    <div class=" p-1 ">
        <button is_modal="1" data-href="{{ route('property_add') }}" class="btn btn-danger btn-sm">Add Rooms</button>

                
                <div class="card-columns mt-1">
                    @foreach ($rooms as $room)
                        <div class="card">
                            {{-- <img class="card-img-top" src="https://a0.muscache.com/im/pictures/20d2a992-2e78-49c6-9ecd-173b0b66f6aa.jpg?im_w=720" alt="Card image cap"> --}}
                            @if($room->mainPhoto())
                            <img class="card-img-top" src="{{$room->mainPhoto()->uPath()}}" alt="Card image cap">
                            @else
                            <div class="alert alert-danger">No Photo Uploaded</div>
                            @endif                            
                            <div class="card-header">
                                {{-- <button  is_modal="1" data-href="{{ route('feature_delete',$feature->id) }}" class="close" >x</button> --}}
                                <h5>{{ $room->name }}</h5>
                            </div>
                            <div class="card-body">
                                
                                <p>{!! $room->description !!}</p>
                            </div>
                            <div class="card-footer">
                                KES {{$room->discounted_price}} - <strike>{{$room->price_per_night}}</strike>

                                <a class="float-right btn btn-xs btn-info my-2" href="{{route('property_view',$room->id)}}">View / Edit</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        
@endsection
