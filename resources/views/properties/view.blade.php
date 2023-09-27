@php
    $pagename = $property->name;
    $pagecramp = 'Create and manage room properties/rooms here !';
@endphp
@extends('partials.main')

@section('content')
    <div class=" p-1 ">
        <button is_modal="1" data-href="{{ route('property_delete',$property->id) }}" class="btn btn-danger btn-sm">Delete Property</button>
        <hr>

        <div class="card-columns mt-1">
            <form class="card" action="{{ route('property_edit', $property->id) }}" method="post">
                @csrf
                <div class="card-header">
                    <h5>Description</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input class="form-control" type="text" name="name" value="{{ $property->name }}"
                            id="">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="form-control" type="text" name="description" id="">{{ $property->description }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Price</label>
                                <input class="form-control" type="text" name="price_per_night"
                                    value="{{ $property->price_per_night }}" id="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Discounted Price</label>
                                <input class="form-control" type="text" name="discounted_price"
                                    value="{{ $property->discounted_price }}" id="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Location</label>
                        <input class="form-control" type="text" name="location" value="{{ $property->location }}"
                            id="">
                    </div>
                    <div class="form-group">
                        <label for="">Coordinates</label>
                        <input class="form-control" type="text" name="coordinates" value="{{ $property->coordinates }}"
                            id="">
                    </div>
                    <div class="form-group">
                        <label for="">No Of Guests</label>
                        <input class="form-control" type="text" name="no_guests" value="{{ $property->no_guests }}"
                            id="">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-md btn-danger" type="submit" value="Update">
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header"><h5>Images</h5></div>
                <div class="card-body">
                    <form action="{{ route('property_image_upload', $property->id) }}" enctype="multipart/form-data"
                        method="post">
                        @csrf
                        <div class="form-group">
                            <label for="image">Upload Image</label>
                            <input type="file" name="image" class="form-control" id="">

                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-sm btn-info" value="Upload">
                        </div>
                    </form>
                    <div class="row">   
                        @foreach  ($property->photos() as $photo)
                        
                            <div class="d-inline  border border-secondary rounde shaddow p-2 m-2">  
                            <img src="{{ $photo['path'] }}" alt="" class="d-block" style="max-width: 150px" >
                            <a is_modal="1" class="text-danger " style="cursor:pointer"  data-href="{{route('remove_image',$photo['id'])}}">Remove </a>
                            </div>
                        @endforeach 
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5> Room Types & Features</h5>
                </div>
                <div class="card-body">
                    <p>Assigned Room Features <i><b>click on a feature to remove it</b></i></p>
                    @foreach ($property->features()->get() as $feature)
                        <form action="{{ route('property_de_assign_feature', $property->id) }}" class="d-inline m-1"
                            method="post">
                            @csrf
                            <input type="hidden" name="feature_id" value="{{ $feature->id }}">
                            <input type="submit" value="{{ $feature->name }}" class="btn btn-sm btn-outline-success m-1">
                        </form>
                    @endforeach
                    <hr>
                    <p>Un Assigned Room Features  <i><b>click on a feature to add it</b></i>
                        <a href="#" class="float-right" is_modal="1" data-href="{{ route('feature_add') }}" >Add Feature</a>
                    </p>
                    @if(!count($property->unassignedFeatures()))
                        <i class="text-center">You have assigned all features !</i>
                    @else
                    @foreach ($property->unassignedFeatures() as $feature)
                        <form action="{{ route('property_assign_feature', $property->id) }}" class="d-inline m-1"
                            method="post">
                            @csrf
                            <input type="hidden" name="feature_id" value="{{ $feature->id }}">
                            <input type="submit" value="{{ $feature->name }}" class="btn btn-sm btn-outline-danger m-1">
                        </form>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
