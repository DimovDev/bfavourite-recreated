        <div class="card card-content card-content-link">
            <div class="card-header">
                <i class="fa fa-link"></i>
                <div>
                 <h3 class="card-subtitle">{{$note->title}}</h3>
                 <span class="card-info"> {{'@' . $note->user->first()->name}} &middot; {{$note->publish_date}} </span>
                </div>
            </div>
            <div class="card-body">
                {!!$note->content!!}
            </div>
            <div class="card-footer">
              <a href="{{$note->getMeta('link_url')}}">
                <img src="{{$note->photo->getSize('medium', true)}}" class="img-fluid" alt="{{$note->getMeta('link_title')}}" />
              </a>
               <div class="card-link">
                 <span>{{$note->getMeta('publisher')}}</span>
                 <a href="{{$note->getMeta('link_url')}}"><h3>{{$note->getMeta('link_title')}}</h3></a>
               </div>
            </div>
            <div class="card-body card-tags">
              @foreach($note->tags()->active()->get() AS $tag)

             <a href="{{route('newsfeed.tag', ['id' => $tag->id,
                                                'slug'=>$tag->slug])}}" class="tag">#{{$tag->name}}</a>
              
              @endforeach
            </div>
        </div>