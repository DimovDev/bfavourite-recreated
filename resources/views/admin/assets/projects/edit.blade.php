@extends('admin/layouts/main')
@inject('projectStatus', 'App\PostStatus')

@section('content')

<h1 class="h2">{{__(isset($project) ? 'Edit Project' : 'Create Project')}}</h1>

@if($errors->any())
 <div class="alert alert-danger">
   <ul>
     @foreach($errors->all() as $error) 
      <li>{{$error}}</li>
     @endforeach
   </ul>
 </div>
@endif

<form method="post" action="{{isset($project) ? route('admin.projects.update', [$project->id]) : route('admin.projects.store')}}">
  <input type="hidden" name="_method" value="{{isset($project) ? 'PUT' : 'POST'}}" />

<div class="form-group">
  <label for="title">{{__('Title')}}</label>
  <input type="text" class="form-control" id="title" name="title" value="{{old('title') ?? $project->title ?? null}}" />
</div>

<div class="form-group">
  <label for="slug">{{__('Slug')}} <small>({{__('Can be generated automatically.')}})</small></label>
  <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug') ?? $project->slug ?? null}}" />
</div>



<div class="form-group">
  <label for="content">{{__('Content')}}</label>
  <textarea class="form-control mce" name="content" id="content">{{old('content') ?? $project->content ?? null}}</textarea>

</div>

<div class="form-group">
  <label for="summary">{{__('Summary')}} <small>({{__('Can be generated automatically.')}})</small></label>
  <textarea class="form-control mce" name="summary" id="summary">{{old('summary') ?? $project->summary ?? null}}</textarea>

</div>

<div class="form-group">
  <label for="github">{{__('Github Url')}}</label>
  <input type="text" class="form-control" id="github" name="meta[github_url]" value="{{old('meta.github_url') ?? isset($project) ? $project->getMeta('github_url'): null}}" />
</div>

<div class="form-group">
  <label for="published_at">{{__('Live Url')}}</label>
  <input type="text" class="form-control" id="live" name="meta[live_url]" value="{{old('meta.live_url') ?? isset($project) ? $project->getMeta('live_url'): null}}" />
</div>

<div class="form-group">
  <label for="published_at">{{__('Published at')}}</label>
  <input type="text" class="form-control" id="published_at" name="published_at" value="{{old('published_at') ?? $project->published_at ?? date('Y-m-d h:m:s')}}" />
</div>

<div class="form-group">
  <label for="asset_status">{{__('Status')}}</label>
  <select id="asset_status" name="asset_status" class="form-control">
    @foreach($projectStatus->all() as $status)
      <option {{$status == old('asset_status') ? 'selected' : null}}>{{$status}}</option>
    @endforeach
  </select>
</div>

<button type="submit" class="btn btn-primary">{{__('Save')}}</button>

@csrf

</form>


@endsection