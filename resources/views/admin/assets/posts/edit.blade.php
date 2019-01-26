@extends('admin/layouts/main')
@inject('postStatus', 'App\PostStatus')

@section('content')

<h1 class="h2">{{__(isset($post) ? 'Edit Post' : 'Create Post')}}</h1>

@if($errors->any())
 <div class="alert alert-danger">
   <ul>
     @foreach($errors->all() as $error) 
      <li>{{$error}}</li>
     @endforeach
   </ul>
 </div>
@endif

<form method="post" action="{{isset($post) ? route('admin.posts.update', [$post->id]) : route('admin.posts.store')}}">
  <input type="hidden" name="_method" value="{{isset($post) ? 'PUT' : 'POST'}}" />

<div class="form-group">
  <label for="title">{{__('Title')}}</label>
  <input type="text" class="form-control" id="title" name="title" value="{{old('title') ?? $post->title ?? null}}" />
</div>

<div class="form-group">
  <label for="slug">{{__('Slug')}} <small>({{__('Can be generated automatically.')}})</small></label>
  <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug') ?? $post->slug ?? null}}" />
</div>



<div class="form-group">
  <label for="content">{{__('Content')}}</label>
  <textarea class="form-control mce" name="content" id="content">{{old('content') ?? $post->content ?? null}}</textarea>

</div>

<div class="form-group">
  <label for="summary">{{__('Summary')}} <small>({{__('Can be generated automatically.')}})</small></label>
  <textarea class="form-control mce" name="summary" id="summary">{{old('summary') ?? $post->summary ?? null}}</textarea>

</div>

<div class="form-group">
  <label for="published_at">{{__('Published at')}}</label>
  <input type="text" class="form-control" id="published_at" name="published_at" value="{{old('published_at') ?? $post->published_at ?? date('Y-m-d h:m:s')}}" />
</div>

<div class="form-group">
  <label for="asset_status">{{__('Status')}}</label>
  <select id="asset_status" name="asset_status" class="form-control">
    @foreach($postStatus->all() as $status)
      <option {{$status == old('asset_status') ? 'selected' : null}}>{{$status}}</option>
    @endforeach
  </select>
</div>

<button type="submit" class="btn btn-primary">{{__('Save')}}</button>

@csrf

</form>


@endsection