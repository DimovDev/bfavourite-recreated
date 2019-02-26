@extends('admin/layouts/main')
@inject('projectStatus', 'App\Models\Asset\PostStatus')
@inject('tag', 'App\Models\Taxonomy\Tag')



@section('main-classes', 'edit projects-edit')

@section('main')

<h1 class="h2">{{__(isset($project) ? 'Edit Project' : 'Create Project')}}</h1>
<hr />

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
  <textarea class="form-control tinymce" name="content" id="content">{{old('content') ?? $project->content ?? null}}</textarea>

</div>

<div class="form-group">
  <label for="summary">{{__('Summary')}} <small>({{__('Can be generated automatically.')}})</small></label>
  <textarea class="form-control" name="summary" id="summary">{{old('summary') ?? $project->summary ?? null}}</textarea>

</div>

<div class="row">

 <div class="col-5">

    <div class="form-group">
      <label for="github">{{__('Github Url')}}</label>
      <input type="text" class="form-control" id="github" name="meta[github_url]" value="{{old('meta.github_url') ?? isset($project) ? $project->getMeta('github_url'): null}}" />
    </div>

  </div><!-- .col -->
  <div class="col-7">
    <div class="form-group">
      <label for="live">{{__('Live Url')}}</label>
      <input type="text" class="form-control" id="live" name="meta[live_url]" value="{{old('meta.live_url') ?? isset($project) ? $project->getMeta('live_url'): null}}" />
    </div>

  </div><!-- .col -->
</div><!-- .row -->

<div class="row">

<div class="col-5">
  <div class="photo">
    <button type="button" class="btn btn-secondary" data-media-field="photo_id" data-media-value="{{old('photo_id') ?? $project->photo ?? null}}">{{__('Add a photo')}}</button>
  </div>
</div>

<div class="col-7">


    <div class="form-group">
      <label for="tags">{{__('Tags')}}</label>
      <input type="text" id="tags" class="form-control" name="tags" data-pillfield="{{old('tags') ?? $project->tags ?? null}}" value="" />
    </div>

    <div class="form-group">
      <label for="published_at">{{__('Published at')}}</label>
      <input type="text" class="form-control" id="published_at" name="published_at" value="{{old('published_at') ?? $project->published_at ?? date('Y-m-d')}}" />
    </div>

    <div class="form-group">
      <label for="asset_status">{{__('Status')}}</label>
      <select id="asset_status" name="asset_status" class="form-control">
        @foreach($projectStatus->all() as $status)
          <option {{old('asset_status') == $status || 
                  (isset($project) && $project->asset_status == $status) ? 'selected' : null}}>{{$status}}</option>
        @endforeach
      </select>
    </div>

  </div><!-- .col -->
</div><!-- .row -->
<button type="submit" class="btn btn-primary float-right">{{__('Save')}}</button>

@csrf

</form>


@endsection

@section('scripts')
 
 @parent;
  
 <script src="{{asset('/js/tinymce/tinymce.js')}}"></script>

@endsection