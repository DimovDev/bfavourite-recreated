@extends('frontend.layouts.main')

@section('main')

<div class="card card-content">
<div class="card-header">
    <i class="fa fa-tag"></i>
    <div>
        <h3 class="card-subtitle">{{__('All notes with tag: ')}} {{$tags->reduce(function($carry, $item) {
                                                                                 $carry .= (!$carry ? null : ', ').'#'.$item->name;
                                                                                 return $carry; 
                                                                                })}}</h3>
 
    </div>
</div>
</div>

@foreach($notes AS $note)
    @php
      $type = in_array($note->asset_type, ['post', 'project']) ? 'archive' : $note->asset_type;
    @endphp

    @component('frontend.components.'.$type, ['note' => $note, 'asset'=> $note])
    @endcomponent
@endforeach

@endsection

