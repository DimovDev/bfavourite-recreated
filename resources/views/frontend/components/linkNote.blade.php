        <div class="card card-content card-content-link">
            <div class="card-header">
                <i class="fa fa-book-open"></i>
                <div>
                 <h3 class="card-subtitle">{{$note->title}}</h3>
                 <span class="card-info"> @SasheVuchkov &middot; {{$note->published_at->format('d M Y')}} </span>
                </div>
            </div>
            <div class="card-body">
                {!!$note->content!!}
            </div>
            <div class="card-footer">
               <img src="/storage/bullseye.jpg" class="img-fluid" alt="" />
               <div class="card-link">
                 <span>{{$note->getMeta('publisher')}}</span>
                 <a href="{{$note->getMeta('link_url')}}"><h3>{{$note->getMeta('link_title')}}</h3></a>
               </div>
            </div>
            <div class="card-body card-tags">
              @foreach($note->tags AS $tag)

              <a href="#" class="tag">#{{$tag->name}}</a>
              
              @endforeach
            </div>
        </div>