@extends('admin/layouts/main')
@inject('taxonomyStatus', 'App\TaxonomyStatus')

@section('content')

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

<div class="form-group">
  <label for="name">{{__('Name')}}</label>
  <input type="text" class="form-control" id="name" name="name" value="{{old('name') ?? $category->name ?? null}}" />
</div>

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

<button type="submit" class="btn btn-primary">{{__('Save')}}</button>

@csrf

</form>


@endsection