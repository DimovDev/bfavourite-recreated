<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Sashe Vuchkov">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard Template · Bootstrap</title>

    <!-- Bootstrap core CSS -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">

    @stack('styles') 
  
  </head>
  <body>

@simpleMenu('Site Navigation', 'frontend.partials.site-navigation')

<header class="site-header">
  <div class="header-bar">
   <div class="container d-flex">
    <img class="header-bar-avatar" src="/storage/sashe.jpg"  alt="Sashe Vuchkov" />
    <ul class="header-bar-stats">
      <li class="d-none d-md-block">Бележки <span>59</span></li>
      <li class="d-none d-md-block">Технологии <span>24</span></li>
      <li class="d-none d-md-block">Проекти <span>7</span></li>
      <li class="d-none d-md-block">Хобита <span>5</span></li>
    </ul>
   </div>
  </div>
</header>


<div class="container">
   
  @section('left-sidebar') 
   @include('frontend/partials/left-sidebar')
  @show
  
   <main class="@yield('main-classes')">
     @yield('main')
   </main>

   @section('right-sidebar')
     @include('frontend/partials/right-sidebar')
   @show
</div>



@section('scripts') 


    <script src="{{ asset('js/site.js') }}" ></script>
    <script type="module" src="{{ asset('js/custom.js') }}" ></script>
    

@show


</html>