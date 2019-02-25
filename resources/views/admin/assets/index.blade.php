@extends('admin/layouts/main')

@inject('icon', 'App\Models\Asset\AssetIcon')

@section('main-classes', 'admin-index posts-index')

@section('main')

      <h1 class="h2">{{__('All Notes')}}</h1>

      @if(!empty($message))
       <div class="alert alert-{{$message->first('status')}}">
         {{__($message->first('message'))}}
       </div>
      @endif

      <div class="table-responsive">

      @if($assets->count() > 0)
        <form method="post" action="{{route('admin.assets.destroy')}}">
        <input type="hidden" name="_method" value="delete" />
        @csrf
      

        <table class="table table-striped table-sm admin-table mt-3">
          <thead>
           <tr>
            <th><input type="checkbox" id="select-all" /> </th>
            <th>{{__('Title')}} </th>
            <th>{{__('Type')}} </th>
            <th>{{__('Tags')}} </th>
        
            <th>{{__('Status')}} </th>
            <th>{{__('Published at')}} </th>
           </tr>
          </thead>
          <tbody>
           
         @foreach($assets AS $asset)

           <tr>
              <td><input type="checkbox" class="destroy" name="destroy[]" value="{{$asset->id}}" /></td>
              <td class="link"> {{$asset->title}} <a href="{{route('admin.'.$asset->asset_type.'s.edit', [$asset->id])}}">{{__('edit')}}</a></td>
              <td><i class="fa fa-{{$icon->get(str_replace('Note', '', $asset->asset_type))}}" title="{{$asset->asset_type}}"></i></td>
              <td>
                @if($asset->tags)
              
                {{$asset->tags->reduce(function($carry, $item) {
 
                  return $carry.(!$carry ? null : ', ').$item->name;
                  
                 })}}

                @endif 
              
              </td>
            
              <td>{{$asset->status}}</td>
              <td>{{$asset->published_at->format('d M Y')}}</td>
           </tr>
          @endforeach
            
                 

          </tbody>
        </table>
        </form>
       @else 
         
         <p>{{__('There are no notes')}}</p>

       @endif

      </div>

      <div class="d-flex align-items-start">

       <button id="destroy-btn" type="submit" class="btn btn-danger mr-5">{{__('Delete')}}</button>
     
        @if($assets->count() < $assets->total())

            {{$assets->links()}}

        @endif
      </div>   
@endsection