@extends('layouts.main');

@section('main-classes', 'project')

@section('main') 

        <div class="card card-content card-content-link">
            <div class="card-header">
         
                <div>
                 <h3 class="">{{$project->title}}</h3>
                 <span class="card-info"> @SasheVuchkov &middot; {{$project->published_at->format('d M Y')}} </span>
                </div>

                
            </div>
            <div class="card-body">
                <img src="/storage/{{$project->photo->url}}" class="img-fluid" alt="" />
                <div class="text-center">
                    <a class="btn btn-dark text-white" href="{{$project->getMeta('github_url')}}"><i class="fab fa-github-alt"></i> {{__('Github')}} </a>
                    <a class="btn btn-primary text-white" href="{{$project->getMeta('live_url')}}"><i class="fa fa-link"></i> {{__('View Online')}} </a>
                </div>
                <p class="card-text">{!!$project->content!!}</p>
            </div>
            <div class="card-footer">
               
               <div class="card-link">
                               @foreach($project->tags AS $tag)

              <a href="#" class="tag">#{{$tag->name}}</a>
              
              @endforeach
               </div>
            </div>
     
        </div>

@endsection
