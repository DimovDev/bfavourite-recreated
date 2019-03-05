@extends('admin/layouts/main')

@section('main')

      <h1 class="h2">{{__('All Media Files')}}</h1>

      @if(!empty($message))
       <div class="alert alert-{{$message->first('status')}}">
         {{__($message->first('message'))}}
       </div>
      @endif

      <div class="table-responsive">

      @if($media->count() > 0)
        <form method="post" action="{{route('admin.media.destroy')}}">
        <input type="hidden" name="_method" value="delete" />
        @csrf
      

        <table class="table table-striped table-sm admin-table media-table mt-3">
          <thead>
           <tr>
            <th><input type="checkbox" id="select-all" /> </th>
            <th></th>
            <th>{{__("Name")}} </th>
            <th>{{__('Created at')}} </th>
            <th>{{__("Updated at")}} </th>
           </tr>
          </thead>
          <tbody>
           
         @foreach($media AS $m)

           <tr>
              <td><input type="checkbox" class="destroy" name="destroy[]" value="{{$m->id}}" /></td>
              <td class="thumb"><img src="{{$m->getSize('small', true)}}" alt="{{$m->title}}" /></td>
              <td class="title">{{$m->title}}</td>
              <td>{{$m->created_at->format('d M Y')}}</td>
              <td>{{$m->updated_at->format('d M Y')}}</td>
           </tr>
          @endforeach
            
                 

          </tbody>
        </table>
        </form>
       @else 
         
         <p>{{__('There are no media files')}}</p>

       @endif

      </div>

      <div class="d-flex align-items-start">

       <button id="destroy-btn" type="submit" class="btn btn-danger mr-5">{{__('Delete')}}</button>
     
        @if($media->count() < $media->total())

            {{$media->links()}}

        @endif
      </div>   
@endsection