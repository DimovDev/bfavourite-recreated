   <aside class="right-sidebar d-none d-md-block">
           <div class="card card-content">
            <div class="card-header">
                <i class="fa fa-star"></i>
                <div>
                 <h3 class="card-subtitle">{{__('Current Project')}}</h3>
                 <span class="card-info"> @SasheVuchkov &middot; {{$current_project->publish_date}}</span>
                </div>
            </div>
            <div class="card-footer">
               <a href="{{route('newsfeed.project', ['id'=>$current_project->id])}}">
                 <img src="{{$current_project->photo->getSize('small', true)}}" class="img-fluid" alt="{{$current_project->title}}" />
               </a>
               <div class="card-link text-center">
                 <a href="{{route('newsfeed.project', ['id'=>$current_project->id])}}"><h3>{{$current_project->title}}</h3></a>
               </div>
            </div>
        </div>
         <div class="card card-content card-sidebar">
            <div class="card-header">
                
                <div>
                 <h3 class="card-subtitle">{{__('Recent Projects')}}</h3>
            
                </div>
            </div>
            <ul class="list-group list-group-flush">
              @foreach ( $recent_projects as $project)
                 <li class="list-group-item"><a href="{{route('newsfeed.project', ['id' => $project->id])}}"><i class="fa fa-angle-double-right"></i> {{$project->title}}</a></li>         
              @endforeach
                
              
            </ul>

        </div>
          <div class="card card-content card-sidebar">
            <div class="card-header">
                <div>
                 <h3 class="card-subtitle">{{__('Recent Posts')}}</h3>
                </div>
            </div>
            <ul class="list-group list-group-flush">
              @foreach ($recent_posts as $post)
                 <li class="list-group-item"><a href="{{route('newsfeed.post', ['id' => $post->id])}}"><i class="fa fa-angle-double-right"></i> {{str_limit($post->title, '55')}}</a></li>         
              @endforeach
            </ul>

        </div>

    </aside> 