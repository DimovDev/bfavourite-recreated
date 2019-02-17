@extends('layouts/main')

@push('styles')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@endpush

@section('left-sidebar') 
      
 @simpleMenu('Admin Menu', 'admin.partials.menu')

@endsection

@section('right-sidebar') 


@endsection