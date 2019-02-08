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
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>
  <body>

  
@section('navigation')
 
  @include('admin/partials/navigation')

@show

<div class="container-fluid">
  <div class="row">

    @section('sidebar')

      @include('admin/partials/sidebar')

    @show
   

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 @yield('main-classes')">
       
      @yield('content')

    </main>
  </div>
</div>

 

@section('scripts') 


    <script src="{{ asset('js/site.js') }}" ></script>
    <script type="module" src="{{ asset('js/custom.js') }}" ></script>
    
  <script>
  $( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];

    $( "#live" ).autocomplete({
      source: availableTags
    });

  } );
  </script>

@show


</html>