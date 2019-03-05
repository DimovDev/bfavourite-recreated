@extends('frontend.layouts.main')

@section('main')

    @foreach($assets AS $asset)
        @component('frontend.components.archive', ['note' => $asset])
        @endcomponent
    @endforeach

@endsection