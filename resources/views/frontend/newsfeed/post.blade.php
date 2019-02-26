@extends('layouts.main');

@section('main-classes', 'blog')

@section('main') 

        <div class="card card-content card-content-link">
            <div class="card-header">
         
                <div>
                 <h3 class="">{{$post->title}}</h3>
                 <span class="card-info"> @SasheVuchkov &middot; {{$post->published_at->format('d M Y')}} </span>
                </div>

                
            </div>
            <div class="card-body">
                 <img src="/storage/bullseye.jpg" class="img-fluid" alt="" />
                <p class="card-text">{!!$post->content!!}</p>
            </div>
            <div class="card-footer">
               
               <div class="card-link">
                               @foreach($post->tags AS $tag)

              <a href="#" class="tag">#{{$tag->name}}</a>
              
              @endforeach
               </div>
            </div>
     
        </div>

@endsection


