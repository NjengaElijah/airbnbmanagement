@php
    $pagename = 'Clients';
    $pagecramp = 'Clients';
@endphp
@extends('partials.main')

@section('content')
    <div class="  ">
        <button is_modal="1" data-href="{{ route('feature_add') }}" class="btn btn-danger btn-sm">Add Feature</button>
        <div class="card mt-2">
            <div class="card-header">
                <div class="col-3">

                </div>
            </div>
            <div class="card-body">
                
                <div class="card-columns">
                    @foreach ($features as $feature)
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="card-body">
                                <h4>{{ $feature->name }}</h4>
                                <h4>{{ $feature->description }}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
