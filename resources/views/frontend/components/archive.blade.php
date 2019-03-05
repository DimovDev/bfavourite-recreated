        <div class="card card-content card-content-link">
            <div class="card-header">
                <i class="fa fa-{{$note->asset_type == 'project' ? 'code': 'infinity'}}"></i>
                <div>
                 <h3 class="card-subtitle">{{str_limit($note->summary, 21)}}</h3>
                 <span class="card-info"> {{'@' . $note->user->first()->name}} &middot; {{$note->publish_date}} </span>
                </div>
            </div>
            <div class="card-body">
                {!!$note->summary!!}
            </div>        
            <div class="card-footer">
              <a href="{{route('newsfeed.'.$note->asset_type, ['id' => $note->id])}}">
                <img src="{{$note->photo->getSize('medium', true)}}" class="img-fluid" alt="{{$note->title}}"  />
              </a>
               <div class="card-link">
                 <a href="{{route('newsfeed.'.$note->asset_type, ['id' => $note->id])}}"><h3>{{$note->title}}</h3></a>
               </div>
           
            </div>
            <div class="card-body card-tags">
              
              
              @foreach($note->tags()->active()->get() AS $tag)

              <a href="{{route('newsfeed.tag', ['id' => $tag->id])}}" class="tag">#{{$tag->name}}</a>
              
              @endforeach
            </div>
        </div>