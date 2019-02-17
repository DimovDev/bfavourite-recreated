@extends('admin/layouts/main')
@inject('taxonomyStatus', 'App\TaxonomyStatus')


@section('main-classes', 'edit categories-edit')

@section('main')

<h1 class="h2">{{__(isset($category) ? 'Edit Category' : 'Create Category')}}</h1>

@if($errors->any())
 <div class="alert alert-danger">
   <ul>
     @foreach($errors->all() as $error) 
      <li>{{$error}}</li>
     @endforeach
   </ul>
 </div>
@endif

<form method="post" action="{{isset($category) ? route('admin.categories.update', [$category->id]) : route('admin.categories.store')}}">
  <input type="hidden" name="_method" value="{{isset($category) ? 'PUT' : 'POST'}}" />

   <div class="row">
    <div class="form-group col-6">
      <label for="name">{{__('Name')}}</label>
      <input type="text" class="form-control" id="name" name="name" value="{{old('name') ?? $category->name ?? null}}" />
    </div>
    </div>

    <div class="row">

      <div class="col-2">
        <div class="photo">
          <button type="button" class="btn btn-secondary" data-media-field="icon" data-media-value="{{old('icon') ?? $category->icon ?? null}}">{{__('Add an icon')}}</button>
        </div>
      </div>

      <div class="col-4">

      <div class="form-group">
        <label for="slug">{{__('Slug')}} <small>({{__('Can be generated automatically.')}})</small></label>
        <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug') ?? $category->slug ?? null}}" />
      </div>

      <div class="form-group">
        <label for="taxonomy_status">{{__('Status')}}</label>
        <select id="taxonomy_status" name="taxonomy_status" class="form-control">
          @foreach($taxonomyStatus->all() as $status)
            <option {{$status == old('taxonomy_status') ? 'selected' : null}}>{{$status}}</option>
          @endforeach
        </select>
      </div>
      
        </div><!-- .col -->
      </div><!-- .row -->

   <div class="row">
    <div class="form-group col-6">
      <label for="summary">{{__('Summary')}}</label>
      <textarea class="form-control" name="summary" id="summary">{{old('summary') ?? $category->summary ?? null}}</textarea>
      <button type="submit" class="btn btn-primary float-right mt-3">{{__('Save')}}</button>
    </div>
    
   </div>



@csrf

</form>


@endsection