@extends('admin/layouts/main')

@section('content')

      <h1 class="h2">{{__('All Posts')}}</h1>

      @if(!empty($message))
       <div class="alert alert-{{$message->first('status')}}">
         {{__($message->first('message'))}}
       </div>
      @endif

      <div class="table-responsive">

      @if($posts->count() > 0)
        <form method="post" action="{{route('admin.posts.destroy')}}">
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
           
         @foreach($posts AS $post)

           <tr>
              <td><input type="checkbox" class="destroy" name="destroy[]" value="{{$post->id}}" /></td>
              <td class="link">{{$post->title}} <a href="{{route('admin.posts.edit', [$post->id])}}">{{__('edit')}}</a></td>
              <td>{{$post->slug}}</td>
              <td>{{$post->status}}</td>
              <td>{{$post->created_at->format('d M Y')}}</td>
              <td>{{$post->updated_at->format('d M Y')}}</td>
           </tr>
          @endforeach
            
                 

          </tbody>
        </table>
        </form>
       @else 
         
         <p>{{__('There are no posts')}}</p>

       @endif

      </div>

      <div class="d-flex align-items-start">

       <button id="destroy-btn" type="submit" class="btn btn-danger mr-5">{{__('Delete')}}</button>
     
        @if($posts->count() < $posts->total())

            {{$categories->links()}}

        @endif
      </div>   
@endsection