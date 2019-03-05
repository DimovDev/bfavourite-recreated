          <div class="card card-content">
            <div class="card-header">
                <i class="fa fa-comment"></i>
                <div>
                 <h3 class="card-subtitle">{{$note->title}}</h3>
                 <span class="card-info"> {{'@' . $note->user->first()->name}} &middot; {{$note->publish_date}}</span>
                </div>
            </div>
            <div class="card-body">
                {!! $note->content !!}
            </div>
            <div class="card-body card-tags">
              @foreach($note->tags()->active()->get() AS $tag)

              <a href="{{route('newsfeed.tag', ['id' => $tag->id,
                                                'slug'=>$tag->slug])}}" class="tag">#{{$tag->name}}</a>
              
              @endforeach
            </div>
        </div>