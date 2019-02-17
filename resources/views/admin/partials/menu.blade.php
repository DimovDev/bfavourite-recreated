  


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

        @foreach ($menu->findByText('Current User') as $link)
             <li class="list-group-item"><a href="{{$link->getUrl()}}"><i class="fa fa-angle-double-right"></i> {{__($link->getText())}}</a></li>
       @endforeach

    </ul>
 </div>

@foreach($menu->findByText('menu') AS $links)

    <div class="card card-content">
        <div class="card-header" data-toggle="collapse" href="#{{$links->getId()}}" role="button">
                <i class="fa fa-{{$links->getIcon()}}"></i>
            <div>
                <h3 class="card-subtitle">{{__($links->getText())}}</h3>

            </div>
        </div>
        
        <ul class="list-group list-group-flush collapse {{$links->getActive() ? 'show' : null}}" id="{{$links->getId()}}">

         @foreach($links AS $link)

            <li class="list-group-item ">
            <a {!! $link->hasItems() ? 'data-toggle="collapse"' : null !!} href="{{$link->hasItems() ? '#'.$link->getId() : $link->getUrl()}}" role="button" >
                <i class="fa fa-angle-double-right"></i> {{ __($link->getText()) }}
            </a>
                <ul class="collapse submenu {{$link->getActive() ? 'show' : null}}" id="{{$link->getId()}}">
                  
               @foreach($link as $child)

                <li><a href="{{$child->getUrl()}}""><i class="fa fa-angle-right"></i>  {{__($child->getText())}}</a></li>

               @endforeach
              </ul>
            </li>

         @endforeach  

        </ul>
    </div>
  @endforeach

</aside>