@extends('frontend.layouts.main')
@inject('projects', 'App\Models\Asset\Project')

@section('main-classes', 'blog page')

@section('main') 

        <div class="card card-content card-content-link">
            <div class="card-header">      
                <div>
                 <h3 class="">Не е просто бизнес...</h3>
                 <span class="card-info"> @SasheVuchkov &middot; PHP / Laravel Developer </span>
                </div>             
            </div>
            <div class="card-body pb-4">
                <p>
                  Писането на код за мрежата е най-голямата ми страст, която никога не угасна и продължи да се връща отново и отново в живота ми.
                </p>
                <p>
                 Дори когато не се занимавах активно с програмиране, в мен тлееше желанието да пиша и на моменти трудно се удържах, докато най-накрая не се пречупих. 
                </p>
                <p>
                  Маркетингът също ми е присърце, както и писането на нехудожествена литретура. 
                </p>
                <p>
                  <strong>
                    Но никога, никога, никога не мога да ги сравня с удоволствието да видя един проект в ума си под формата на код, с неудържимия стремеж да отворя редактора веднага, с удовлетворението от крайния резултат. 
                  </strong>
                </p>
                <p>
                  Пет години по-късно се връщам отново към програмирането... 
                </p>
                <p>
                   И този път ще бъде повече от хоби и повече от бизнес - ще бъде легендарно приключение!
                </p>
            </div>
     
        </div>

        <div id="skills" class="card card-content">
            <div class="card-header">
                 <h3 class="">Лична оценка на уменията ми</h3>
            </div>

          <div class="card-body pb-3">
                <h3 class="mt-3"> Backend </h3>
           <div class="progress">
             <div class="progress-bar" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">PHP7</div>
           </div>
         <div class="progress">
             <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">Laravel 5.7+</div>
           </div>
            <div class="progress">
             <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">MySQL</div>
           </div>
            <div class="progress">
             <div class="progress-bar" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">Wordpress</div>
           </div>
            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">Python (early stage)</div>
           </div>

           <h3 class="mt-3"> Fundamentals </h3>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">OOP</div>
                </div>
                 <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Design Patterns</div>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">SOLID Principles</div>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Algorithms and Data Structures</div>
                </div>
            <h3 class="mt-3"> Frontend </h3>

            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">HTML5</div>
            </div>
             <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">CSS3</div>
            </div>
             <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">Javascript (ES6)</div>
            </div>
            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">jQuery</div>
            </div>
             <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">Bootstrap 4</div>
            </div>


            </div>
     
        </div> 

         <div id="portfolio" class="card card-content pt-3">

            <div class="card-body py-4">

                <div class="row no-gutters">

                   @foreach($projects->featured(3)->get() as $p)

                    <div class="col-12 col-lg-4 mb-3">
                        <img src="{{$p->photo->getSize('medium')}}" alt="{{$p->title}}" class="img-fluid" />
                        <a href="{{route('newsfeed.project', ['id' => $p->id,
                                                              'slug' => $p->slug]).'#first-screen'}}">{{$p->title}}</a>
                    </div>

                   @endforeach


                <div class="col-12">
                    <a class="read-more btn btn-primary"  href="{{route('newsfeed.projects').'#first-screen'}}" role="button">
                    Виж всички проекти
                    </a>
                </div>

                </div>
            </div>
     
        </div> 


         <div id="interests" class="card card-content">

             <div class="card-header">
                 <h3 class="">Други мои интереси и хобита</h3>
            </div>

            <div class="card-body py-2">
                <i class="fa fa-star" aria-hidden="true"></i>
                <h4>Дигитален маркетинг</h4>
                <p>Обожавам да мисля как да създам и предложа стойност така, че всички замесени да спечелят.
         
                  Това, че живеем в условията на свободен пазар насред Информационната ера само ми помага да оправдавам почти болния си интерес на тази тема. 
                </p>
            </div>

             <div class="card-body py-2">
               <i class="fa fa-heartbeat" aria-hidden="true"></i>
               <h4>Фитнес</h4>
               <p>В най-трудния си период тежах с 30 кг повече от нормалното за моите години и ръст.
          
                 Залитането по фитнеса даде старт на нов етап в живота ми, в който не само се чувствам отлично, но и така изглеждам.  
                </p>
             </div>     

            <div class="card-body py-2">
              <i class="fa fa-cogs" aria-hidden="true"></i>
              <h4>Ускорено учене</h4>
              <p>За мен ученето е висша ценност и любимо занимание, което върша с удоволствие.
       
                 Освен това се стремя да поемам колкото се може повече знания и умения, за колкото се може по-кратко време.</p>         
            </div>  

        </div> 




@endsection

@section('right-sidebar', '')