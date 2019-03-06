@extends('layouts/main')

@push('styles')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
  
@endpush

@section('left-sidebar') 

  @if(auth()->check())    
   @simpleMenu('Admin Menu', 'admin.partials.menu')
  @endif
  
@endsection

@section('right-sidebar') 


@endsection