   <aside class="left-sidebar">
      <div class="about">
        <svg class="avatar-arc" viewBox="0 0 100 45"  preserveAspectRatio="none">
         <path class="arc-border" stroke-width="0.5" d="M 0 -31 A 1 1 0 0 0 100 0" />
           
          
        </svg>

        <div class="about-body">
          <h3><a href="#" >Саше Вучков</a></h3>
          

          <p><a href="#">@SasheVuchkov</a> <br /> PHP/Laravel Developer</p>

          <span class="location">
             <i class="fas fa-map-marker-alt"></i>
             <br />
             Sofia, Bulgaria
          </span>
        </div>
      </div>
      <svg class="aside-divider" viewBox="0 0 100 30" preserveAspectRatio="none">

        <path class="top top-border" d="M 0 0 L 100 0 L 50 10 L 0 0" />
        <path class="top" d="M 0 0 L 100 0 L 50 10 L 0 0" />
    
        <path class="middle" d="M 0 2 L 50 12 L 100 2 L 100 8 L 50 20 L 0 8 L 0 2" />
        
        <path class="bottom" d="M 0 10 l 0 25 L 100 35 L 100 10 L 50 22 L 0 10"  />
      </svg>
      
      <div class="techs">
        <h3>{{__('Technologies')}}</h3>

        @foreach($techs AS $tech)
          <a href="{{route('newsfeed.tag', ['id' => $tech->id,
                                            'slug' => $tech->slug]).'#first-screen'}}" class="tag"> #{{$tech->name}} ({{$tech->assets_num}})</a>
        @endforeach
  
      </div>

       <svg class="tech-divider aside-divider" viewBox="0 0 100 25" preserveAspectRatio="none">

        <path class="bottom" d="M 0 0 L 100 0 L 100 3 L 0 3 M 100 3 L 50 13 L 0 3" />

        <path class="middle" d="M 0 13 L 0 25 L 100 30 L 100 5 L 50 15 L 0 5"  />
      </svg>

      <div class="content text-white">
        <h3>{{__('Content')}}</h3>
        
        @foreach($content AS $c)
          <span>{{__(ucfirst($c->obj_type).'s')}} ({{$c->assets_num}})</span>
        @endforeach

       
      </div>
      
       <svg class="aside-divider" viewBox="0 0 100 25" preserveAspectRatio="none">

        <path class="middle" d="M 0 0 L 100 0 L 50 10 L 0 0" />
      </svg>

    </aside>