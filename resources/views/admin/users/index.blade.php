@extends('admin/layouts/main')
@section('main-classes', 'admin-index users-index')
@section('main')

      <h1 class="h2">{{__('All Users')}}</h1>

      @if(!empty($message))
       <div class="alert alert-{{$message->first('status')}}">
         {{__($message->first('message'))}}
       </div>
      @endif

      <div class="table-responsive">

      @if($users->count() > 0)
        <form method="post" action="{{route('admin.users.destroy')}}">
        <input type="hidden" name="_method" value="delete" />
        @csrf
      

        <table class="table table-striped table-sm admin-table mt-3">
          <thead>
           <tr>
            <th><input type="checkbox" id="select-all" /> </th>
            <th>{{__("Name")}} </th>
            <th>{{__('Email')}} </th>
            <th>{{__('Role')}} </th>
            <th>{{__("Status")}} </th>
            <th>{{__('Created at')}} </th>
            <th>{{__("Updated at")}} </th>
           </tr>
          </thead>
          <tbody>
           
         @foreach($users AS $user)

           <tr>
              <td><input type="checkbox" class="destroy" name="destroy[]" value="{{$user->id}}" /></td>
              <td class="link">{{$user->name}} <a href="{{route('admin.users.edit', [$user->id])}}">{{__('edit')}}</a></td>
              <td>{{$user->email}}</td>
              <td>{{$user->role}}</td>
              <td>{{$user->status}}</td>
              <td>{{$user->created_at->format('d M Y')}}</td>
              <td>{{$user->updated_at->format('d M Y')}}</td>
           </tr>
          @endforeach
            
                 

          </tbody>
        </table>
        </form>
       @else 
         
         <p>{{__('There are no users')}}</p>

       @endif

      </div>

      <div class="d-flex align-items-start">

       <button id="destroy-btn" type="submit" class="btn btn-danger mr-5">{{__('Delete')}}</button>
     
        @if($users->count() < $users->total())

            {{$users->links()}}

        @endif
      </div>   
@endsection