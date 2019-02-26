@extends('layouts.main');

@section('main')


@foreach($notes AS $note)
    @component('frontend.components.'.$note->asset_type, ['note' => $note])
    @endcomponent
@endforeach

@endsection