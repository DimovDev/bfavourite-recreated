     
 <nav class="navbar navbar-expand-lg fixed-top site-nav">
  <div class="container">
    <a class="navbar-brand" href="/">
      <img src="/storage/bfavourite-logo-transparent35.png" alt="BFavourite.com" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">

         @foreach($menu as $link)
           
            <li class="nav-item {{$link->getActive() ? 'active' : null}}">
                <a class="nav-link" href="{{$link->getUrl()}}">{{__($link->getText())}}</a>
            </li>

          @endforeach
       </ul>

    </div>
   </div> 
</nav>