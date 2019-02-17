@extends('admin/layouts/main')
@inject('taxonomyStatus', 'App\TaxonomyStatus')


@section('main-classes', 'edit categories-edit')

@section('main')

<h1 class="h2">{{__(isset($tag) ? 'Edit Tag' : 'Create Tag')}}</h1>

@if($errors->any())
 <div class="alert alert-danger">
   <ul>
     @foreach($errors->all() as $error) 
      <li>{{$error}}</li>
     @endforeach
   </ul>
 </div>
@endif

<form method="post" action="{{isset($tag) ? route('admin.tags.update', [$tag->id]) : route('admin.tags.store')}}">
  <input type="hidden" name="_method" value="{{isset($tag) ? 'PUT' : 'POST'}}" />

   <div class="row">
    <div class="form-group col-12">
      <label for="name">{{__('Name')}}</label>
      <input type="text" class="form-control" id="name" name="name" value="{{old('name') ?? $tag->name ?? null}}" />
    </div>
    </div>

    <div class="row">

      <div class="col-3">
        <div class="photo">
          <button type="button" class="btn btn-secondary" data-media-field="icon" data-media-value="{{old('icon') ?? $tag->icon ?? null}}">{{__('Add an icon')}}</button>
        </div>
      </div>

      <div class="col-9">

      <div class="form-group">
        <label for="slug">{{__('Slug')}} <small>({{__('Can be generated automatically.')}})</small></label>
        <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug') ?? $tag->slug ?? null}}" />
      </div>

      <div class="form-group">
        <label for="taxonomy_status">{{__('Status')}}</label>
        <select id="taxonomy_status" name="taxonomy_status" class="form-control">
          @foreach($taxonomyStatus->all() as $status)
            
            <option {{old('taxonomy_status') == $status || 
                    (isset($tag) && $tag->taxonomy_status == $status) ? 'selected' : null}}>{{$status}}</option>
          @endforeach
        </select>
      </div>
      
        </div><!-- .col -->
      </div><!-- .row -->

   <div class="row">
    <div class="form-group col-12">
      <label for="summary">{{__('Summary')}}</label>
      <textarea class="form-control" name="summary" id="summary">{{old('summary') ?? $tag->summary ?? null}}</textarea>
      <button type="submit" class="btn btn-primary float-right mt-3">{{__('Save')}}</button>
    </div>
    
   </div>



@csrf

</form>


@endsection