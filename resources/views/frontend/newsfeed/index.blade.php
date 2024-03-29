@extends('frontend.layouts.main')

@section('main')


@foreach($notes AS $note)
    @php
      $type = in_array($note->asset_type, ['post', 'project']) ? 'archive' : $note->asset_type;
    @endphp

    @component('frontend.components.'.$type, ['note' => $note])
    @endcomponent
@endforeach

@if($notes->lastPage() != 1)

{{$notes->fragment('first-screen')->links()}}

@endif

@endsection