@php
    $pagename = 'Features';
    $pagecramp = 'Create and manage room features here !';
@endphp
@extends('partials.main')

@section('content')
    <div class=" p-1 ">
        <button is_modal="1" data-href="{{ route('feature_add') }}" class="btn btn-danger btn-sm">Add Feature</button>

                
                <div class="card-columns mt-1">
                    @foreach ($features as $feature)
                        <div class="card">
                            <div class="card-header">
                                <button  is_modal="1" data-href="{{ route('feature_delete',$feature->id) }}" class="close" >x</button>
                            </div>
                            <div class="card-body">
                                <h5>{{ $feature->name }}</h5>
                                <p>{{ $feature->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        
@endsection
