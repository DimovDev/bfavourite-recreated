@extends('frontend.layouts.main')

@section('main-classes', 'project')

@section('main') 

        <div class="card card-content card-content-link">
            <div class="card-header">
         
                <div>
                 <h1 class="">{{$project->title}}</h1>
                 <span class="card-info"> {{'@' . $project->user->first()->name}} &middot; {{$project->publish_date}} </span>
                </div>

                
            </div>
            <div class="card-body">
                <img src="{{$project->photo->getSize('medium', true)}}" class="img-fluid" alt="" />
                <div class="text-center py-3">
                    @if($project->getMeta('github_url'))
                      <a target="_blank" class="btn btn-dark text-white" href="{{$project->getMeta('github_url')}}"><i class="fab fa-github-alt"></i> {{__('Github')}} </a>
                    @endif
                    @if($project->getMeta('live_url'))
                      <a target="_blank" class="btn {{$project->getMeta('github_url') ? 'btn-primary' : 'btn-dark'}} text-white" href="{{$project->getMeta('live_url')}}"><i class="fa fa-link"></i> {{__('View Online')}} </a>
                    @endif
                </div>
                {!!$project->content!!}

                  <div class="text-center py-3">
                    @if($project->getMeta('github_url'))
                      <a target="_blank" class="btn btn-dark text-white" href="{{$project->getMeta('github_url')}}"><i class="fab fa-github-alt"></i> {{__('Github')}} </a>
                    @endif
                    @if($project->getMeta('live_url'))
                      <a  target="_blank" class="btn {{$project->getMeta('github_url') ? 'btn-primary' : 'btn-dark'}} text-white" href="{{$project->getMeta('live_url')}}"><i class="fa fa-link"></i> {{__('View Online')}} </a>
                    @endif
                </div>
            </div>
            <div class="card-footer">
               
               <div class="card-link">
                               @foreach($project->tags()->active()->get() AS $tag)

              <a href="{{route('newsfeed.tag', ['id' => $tag->id,
                                                'slug'=>$tag->slug]).'#first-screen'}}" class="tag">#{{$tag->name}}</a>
              
              @endforeach
               </div>
            </div>
     
        </div>

@endsection

@section('right-sidebar', '')