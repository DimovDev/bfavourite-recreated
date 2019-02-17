@extends('admin/layouts/main')

@section('main')

      <h1 class="h2">{{__('All Projects')}}</h1>

      @if(!empty($message))
       <div class="alert alert-{{$message->first('status')}}">
         {{__($message->first('message'))}}
       </div>
      @endif

      <div class="table-responsive">

      @if($projects->count() > 0)
        <form method="post" action="{{route('admin.projects.destroy')}}">
        <input type="hidden" name="_method" value="delete" />
        @csrf
      

        <table class="table table-striped table-sm admin-table mt-3">
          <thead>
           <tr>
            <th><input type="checkbox" id="select-all" /> </th>
            <th>{{__('Title')}} </th>
            <th>{{__('Categories')}} </th>
            <th>{{__('Slug')}} </th>
            <th>{{__('Github')}} </th>
            <th>{{__('Live')}} </th>
            <th>{{__('Status')}} </th>
            <th>{{__('Created at')}} </th>
            <th>{{__('Updated at')}} </th>
           </tr>
          </thead>
          <tbody>
           
         @foreach($projects AS $project)

           <tr>
              <td><input type="checkbox" class="destroy" name="destroy[]" value="{{$project->id}}" /></td>
              <td class="link">{{$project->title}} <a href="{{route('admin.projects.edit', [$project->id])}}">{{__('edit')}}</a></td>
              
              <td>{{$project->categories->reduce(function($carry, $item) {
                      return $carry.(!$carry ? null : ', ').$item->name;
                  })}}
              </td>
             
              <td>{{$project->slug}}</td>
              
              <td>{{$project->assetsMeta()->where('meta_key', 'github_url')->count() ? __('Yes') : __('No')}}</td>
              <td>{{$project->assetsMeta()->where('meta_key', 'live_url')->count() ? __('Yes') : __('No')}}</td>
              
              <td>{{$project->status}}</td>
              
              <td>{{$project->created_at->format('d M Y')}}</td>
              <td>{{$project->updated_at->format('d M Y')}}</td>
           </tr>
          @endforeach
            
                 

          </tbody>
        </table>
        </form>
       @else 
         
         <p>{{__('There are no projects')}}</p>

       @endif

      </div>

      <div class="d-flex align-items-start">

       <button id="destroy-btn" type="submit" class="btn btn-danger mr-5">{{__('Delete')}}</button>
     
        @if($projects->count() < $projects->total())

            {{$projects->links()}}

        @endif
      </div>   
@endsection