@extends('frontend.layouts.main')

@section('main')

    @foreach($assets AS $asset)
        @component('frontend.components.archive', ['note' => $asset])
        @endcomponent
    @endforeach

    @if($assets->lastPage() != 1)

      {{$assets->fragment('first-screen')->links()}}

    @endif

@endsection