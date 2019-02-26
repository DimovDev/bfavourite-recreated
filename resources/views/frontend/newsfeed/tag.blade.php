@extends('layouts.main');

@section('main')

<div class="card card-content">
<div class="card-header">
    <i class="fa fa-tag"></i>
    <div>
        <h3 class="card-subtitle">{{__('All notes with tags: ')}} {{$tags->reduce(function($carry, $item) {
                                                                                 $carry .= (!$carry ? null : ', ').'#'.$item->name;
                                                                                 return $carry; 
                                                                                })}}</h3>
 
    </div>
</div>
</div>

@foreach($notes AS $note)
    @component('frontend.components.'.$note->asset_type, ['note' => $note])
    @endcomponent
@endforeach

@endsection

