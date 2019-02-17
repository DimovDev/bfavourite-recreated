@extends('admin/layouts/main')
@section('main-classes', 'admin-index tags-index')
@section('main')

      <h1 class="h2">{{__('All Tags')}}</h1>

      @if(!empty($message))
       <div class="alert alert-{{$message->first('status')}}">
         {{__($message->first('message'))}}
       </div>
      @endif

      <div class="table-responsive">

      @if($tags->count() > 0)
        <form method="post" action="{{route('admin.tags.destroy')}}">
        <input type="hidden" name="_method" value="delete" />
        @csrf
      

        <table class="table table-striped table-sm admin-table mt-3">
          <thead>
           <tr>
            <th><input type="checkbox" id="select-all" /> </th>
            <th>{{__("Name")}} </th>
            <th>{{__('Slug')}} </th>
            <th>{{__("Status")}} </th>
            <th>{{__('Created at')}} </th>
            <th>{{__("Updated at")}} </th>
           </tr>
          </thead>
          <tbody>
           
         @foreach($tags AS $tag)

           <tr>
              <td><input type="checkbox" class="destroy" name="destroy[]" value="{{$tag->id}}" /></td>
              <td class="link">{{$tag->name}} <a href="{{route('admin.tags.edit', [$tag->id])}}">{{__('edit')}}</a></td>
              <td>{{$tag->slug}}</td>
              <td>{{$tag->status}}</td>
              <td>{{$tag->created_at->format('d M Y')}}</td>
              <td>{{$tag->updated_at->format('d M Y')}}</td>
           </tr>
          @endforeach
            
                 

          </tbody>
        </table>
        </form>
       @else 
         
         <p>{{__('There are no categories')}}</p>

       @endif

      </div>

      <div class="d-flex align-items-start">

       <button id="destroy-btn" type="submit" class="btn btn-danger mr-5">{{__('Delete')}}</button>
     
        @if($tags->count() < $tags->total())

            {{$tags->links()}}

        @endif
      </div>   
@endsection