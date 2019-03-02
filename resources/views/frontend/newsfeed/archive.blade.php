@extends('frontend.layouts.main')

@section('main')

    @foreach($assets AS $asset)
        @component('frontend.components.archive', ['asset' => $asset])
        @endcomponent
    @endforeach

@endsection