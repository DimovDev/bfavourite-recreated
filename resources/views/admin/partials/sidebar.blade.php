   <aside class="right-sidebar d-none d-md-block">
           <div class="card card-content">
            <div class="card-header">
                <i class="fa fa-star"></i>
                <div>
                 <h3 class="card-subtitle">Админ панел</h3>
                 <span class="card-info"> @SasheVuchkov (изход) </span>
                </div>
            </div>
            <div class="card-footer">
               <img src="/storage/sashe.jpg" class="img-fluid" alt="" />
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><i class="fa fa-angle-double-right"></i> {{__('Edit Your Profile')}}</li>
                <li class="list-group-item"><i class="fa fa-angle-double-right"></i> {{__('Go Home')}}</li>
                <li class="list-group-item"><i class="fa fa-angle-double-right"></i> {{__('Logout')}}</li>
            </ul>
        </div>


         <div class="card card-content">
            <div class="card-header" data-toggle="collapse" href="#collapseExample1" role="button">
                 <i class="fa fa-users"></i>
                <div>
                 <h3 class="card-subtitle">{{__('Newsfeed')}}</h3>
            
                </div>
            </div>
            <ul class="list-group list-group-flush collapse" id="collapseExample1">
             <li class="list-group-item">
                <a  href="">
                    <i class="fa fa-angle-double-right"></i> {{ __('All Notes') }}
                </a>
               </li> 
              <li class="list-group-item dropdown dropright ">
                <a data-toggle="collapse" href="#collapseExample" role="button" >
                    <i class="fa fa-angle-double-right"></i> {{ __('Create Note') }}
                </a>
                 <ul class="collapse submenu" id="collapseExample">
                    <li><a href="#"><i class="fa fa-angle-right"></i>  {{__('Create Text')}}</a></li>
                    <li><a href="#"><i class="fa fa-angle-right"></i> {{__('Create Link')}}</a></li>
                    <li><a href="#"><i class="fa fa-angle-right"></i> {{__('Create Photo')}}</a></li>
                 </ul>
              </li>
            </ul>
        </div>

        <div class="card card-content">
            <div class="card-header">
                 <i class="fa fa-edit"></i>
                <div>

                 <h3 class="card-subtitle">{{__('Posts')}}</h3>
            
                </div>
            </div>
            <ul class="list-group list-group-flush">
             <li class="list-group-item">
                <a  href="{{route('admin.posts.index')}}">
                    <i class="fa fa-angle-double-right"></i> {{ __('All Posts') }}
                </a>
               </li> 
              <li class="list-group-item">
                <a href="{{route('admin.posts.create')}}">
                    <i class="fa fa-angle-double-right"></i> {{ __('Create Post') }}
                </a>
              </li>
            </ul>
        </div>

       <div class="card card-content">
            <div class="card-header">
                 <i class="fa fa-code"></i>
                <div>

                 <h3 class="card-subtitle">{{__('Projects')}}</h3>
            
                </div>
            </div>
            <ul class="list-group list-group-flush">
             <li class="list-group-item">
                <a  href="{{route('admin.projects.index')}}">
                    <i class="fa fa-angle-double-right"></i> {{ __('All Projects') }}
                </a>
               </li> 
              <li class="list-group-item">
                <a href="{{route('admin.projects.create')}}">
                    <i class="fa fa-angle-double-right"></i> {{ __('Create Project') }}
                </a>
              </li>
            </ul>
        </div>

       <div class="card card-content">
            <div class="card-header">
                 <i class="fa fa-tags"></i>
                <div>

                 <h3 class="card-subtitle">{{__('Tags')}}</h3>
            
                </div>
            </div>
            <ul class="list-group list-group-flush">
             <li class="list-group-item">
                <a  href="{{route('admin.categories.index')}}">
                    <i class="fa fa-angle-double-right"></i> {{ __('All Tags') }}
                </a>
               </li> 
              <li class="list-group-item">
                <a href="{{route('admin.categories.create')}}">
                    <i class="fa fa-angle-double-right"></i> {{ __('Create Tags') }}
                </a>
              </li>
            </ul>
        </div>



         <div class="card card-content">
            <div class="card-header">
                 <i class="fa fa-users"></i>
                <div>
                 <h3 class="card-subtitle">{{__('Users')}}</h3>
            
                </div>
            </div>
            <ul class="list-group list-group-flush">
             <li class="list-group-item">
                <a  href="{{route('admin.users.index')}}">
                    <i class="fa fa-angle-double-right"></i> {{ __('All Users') }}
                </a>
               </li> 
              <li class="list-group-item">
                <a href="{{route('admin.users.create')}}">
                    <i class="fa fa-angle-double-right"></i> {{ __('Create User') }}
                </a>
              </li>
            </ul>
        </div>


    </aside> 