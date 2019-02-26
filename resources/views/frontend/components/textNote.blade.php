          <div class="card card-content">
            <div class="card-header">
                <i class="fa fa-car"></i>
                <div>
                 <h3 class="card-subtitle">{{$note->title}}</h3>
                 <span class="card-info"> @SasheVuchkov &middot; {{$note->published_at->format('d M Y')}}</span>
                </div>
            </div>
            <div class="card-body">
                {!! $note->content !!}
            </div>
            <div class="card-body card-tags">
              @foreach($note->tags AS $tag)

              <a href="#" class="tag">#{{$tag->name}}</a>
              
              @endforeach
            </div>
        </div>