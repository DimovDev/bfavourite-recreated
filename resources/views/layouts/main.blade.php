<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Sashe Vuchkov">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @foreach($meta_tags AS $tag) 
       <meta {{stripos($tag['name'], 'og') === 0 ? 'property' : 'name'}}="{{$tag['name']}}" content="{{$tag['content']}}" />
    @endforeach

       <meta property="og:locale" content="bg_BG" />
       <meta property="og:site_name" content="{{config('app.name')}}" />

    <title>{!! $page_title->push(config('app.name'))->get() !!}</title>

    <!-- Bootstrap core CSS -->

    <link href="{{ asset('css/site.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet" />

    @stack('styles') 
  
  </head>
  <body>

@simpleMenu('Site Navigation', 'frontend.partials.site-navigation')

<header class="site-header">
  <div class="header-bar">
   <div class="container d-flex">
   
     <img class="header-bar-avatar" src="/storage/sashe.jpg"  alt="Sashe Vuchkov" />

    <ul class="header-bar-stats">
      <li id="notes-link"class="d-none d-md-block">{{__('Notes')}} <span>{{$total_assets}}</span></li>
      <li id="techs-link" class="d-none d-md-block">{{__('Technologies')}} <span>{{$total_techs}}</span></li>
      <li id="projects-link" class="d-none d-md-block"><a href="{{url('/projects')}}">{{__('Проекти')}} <span>{{$total_projects}}</span></a></li>
      <li id="interests-link" class="d-none d-md-block"><a href="{{url('/about')}}#interests">{{__('Interests')}} <span>4</span></a></li>
    </ul>
   </div>
  </div>
</header>
         
          <div  id="popper-avatar" class="card card-popup">

            <div class="card-body py-2 text-center">
                <i class="fa fa-heart" aria-hidden="true"></i>
                <i class="fa fa-heart" aria-hidden="true"></i>
                <i class="fa fa-heart" aria-hidden="true"></i><br />
                Както е казвал Чърчил едно времe: <br />Many, many thanks for your visit!<br />
                <i class="fa fa-heart" aria-hidden="true"></i>
                <i class="fa fa-heart" aria-hidden="true"></i>
                <i class="fa fa-heart" aria-hidden="true"></i>
            </div>

         </div>

         <div  id="popper-interests" class="card card-popup">

            <div class="card-body py-2">
                <i class="fa fa-star" aria-hidden="true"></i>
                <h4>Дигитален маркетинг</h4>
            </div>

             <div class="card-body py-2">
               <i class="fa fa-heartbeat" aria-hidden="true"></i>
               <h4>Фитнес</h4>
             </div>     

            <div class="card-body py-2">
              <i class="fa fa-cogs" aria-hidden="true"></i>
              <h4>Ускорено учене</h4>  
            </div>
            <div class="card-body py-2">
                <i class="fa fa-lightbulb" aria-hidden="true"></i>
                <h4>Работа с подсъзнанието</h4>  
            </div>    

        </div> 
           
         @inject('projects', 'App\Models\Asset\Project')  
         <div  id="popper-projects" class="card card-popup py-2">
           
            @foreach($projects->featured(3)->get() as $p)

              <div class="card-body py-0">
                <i class="fa fa-star" aria-hidden="true"></i>
                <h4>{{$p->title}}</h4>
               </div>


            @endforeach
              <div class="card-body py-0">
                <small>Кликнете, за да видите всички проекти...</small>
              </div>  
        </div> 

 
         <div  id="popper-techs" class="card card-popup py-2">
           <div class="card-body py-0">
                
                <h4>#PHP 7 </h4>&nbsp;&nbsp;
               
                <h4>#Laravel </h4>&nbsp;&nbsp;
               
                <h4>#JavaScript </h4>&nbsp;&nbsp;

                 <br />

                <h4>#jQuery </h4>&nbsp;&nbsp;

                <h4>#HTML5 </h4>&nbsp;&nbsp;

                <h4>#CSS3 </h4>&nbsp;&nbsp;

                 <br />
               
                <h4>#MySQL </h4>&nbsp;&nbsp;
            
                 <h4>и други...</h4>
             </div>
        </div> 

         <div  id="popper-notes" class="card card-popup py-2">
           <div class="card-body py-0">
             <i class="fa fa-info" aria-hidden="true"></i>
             Напоследък не ми остава много<br />
             време да пиша, но се старая<br />
             на сайта ми да има актуално<br />
             съдръжание.    
            </div>
        </div> 
<div class="container">
   
  @yield('left-sidebar') 
  

  
   <main class="@yield('main-classes')">
     @yield('main')
   </main>

   @yield('right-sidebar')


</div>


    <footer class="site-footer" id="contacts">

      <div class="container">
      
       <div class="row">

           <div class="col col-12 col-lg-5">
             <h4>За BFavourite.com</h4>
             <p>„Писането на код за мрежата е една от най- големите ми страсти, която никога не угасна и продължи да се връща отново и отново в живота ми.“</p>
             <p>~ Саше Вучков</p>
             <p>BFavourite.com е моята визитка, с която да демонстрирам своите знания и умнения в сферата на уеб програмирането.</p>
           </div>

           <div class="col col-12 col-lg-4 offset-lg-3">
             <h4>Информация за контакт</h4>
             <p><strong>Email: </strong>sashe@bfavourite.com <br/>
                <strong>GSM: </strong>0899 825 654</p>
              <p><strong>Работно време:</strong><br />
                Пон-Пет: 08:00 – 18:00</p>
              <p><strong>Адрес: </strong><br />
                 Младост 1А, бл. 514, вх. А, ап. 13, София</p>
           </div>
      </div><!-- .row -->
     </div><!-- .container -->
     <p>© {{date('Y')}} Всички права запазени от Саше Вучков</p>
    </footer>

@section('scripts') 


    <script src="{{ asset('js/site.js') }}" ></script>    
    <script src="{{ asset('js/frontend.js') }}" ></script>   

@show

  </body>
</html>