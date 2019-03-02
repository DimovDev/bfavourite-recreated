@extends('frontend.layouts.main')

@section('main-classes', 'project')

@section('main') 

        <div class="card card-content card-content-link">
            <div class="card-header">
         
                <div>
                 <h3 class="">{{$project->title}}</h3>
                 <span class="card-info"> {{'@' . $project->user->first()->name}} &middot; {{$project->publish_date}} </span>
                </div>

                
            </div>
            <div class="card-body">
                <img src="{{$project->photo->getSize('medium', true)}}" class="img-fluid" alt="" />
                <div class="text-center">
                    @if($project->getMeta('github_url'))
                      <a class="btn btn-dark text-white" href="{{$project->getMeta('github_url')}}"><i class="fab fa-github-alt"></i> {{__('Github')}} </a>
                    @endif
                    @if($project->getMeta('live_url'))
                      <a class="btn {{$project->getMeta('github_url') ? 'btn-primary' : 'btn-dark'}} text-white" href="{{$project->getMeta('live_url')}}"><i class="fa fa-link"></i> {{__('View Online')}} </a>
                    @endif
                </div>
                <p class="card-text">{!!$project->content!!}</p>
            </div>
            <div class="card-footer">
               
               <div class="card-link">
                               @foreach($project->tags AS $tag)

              <a href="{{route('newsfeed.tag', ['id' => $tag->id])}}" class="tag">#{{$tag->name}}</a>
              
              @endforeach
               </div>
            </div>
     
        </div>

@endsection

@section('right-sidebar', '')