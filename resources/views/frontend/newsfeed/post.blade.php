@extends('frontend.layouts.main')

@section('main-classes', 'blog')

@section('main') 

        <div class="card card-content card-content-link">
            <div class="card-header">
         
                <div>
                 <h1 class="">{{$post->title}}</h1>
                 <span class="card-info"> {{'@' . $post->user->first()->name}} &middot; {{$post->publish_date}} </span>
                </div>

                
            </div>
            <div class="card-body">
                 <img src="{{$post->photo->getSize('medium', true)}}" class="img-fluid mb-4" alt="{{$post->title}}" />
                {!!$post->content!!}
            </div>
            <div class="card-footer">
               
               <div class="card-link">
                               @foreach($post->tags()->active()->get() AS $tag)

              <a href="{{route('newsfeed.tag', ['id' => $tag->id,
                                                'slug'=>$tag->slug]).'#first-screen'}}" class="tag">#{{$tag->name}}</a>
              
              @endforeach
               </div>
            </div>
     
        </div>

@endsection

@section('right-sidebar', '')
