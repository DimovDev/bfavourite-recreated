@extends('admin/layouts/main')
@inject('linkStatus', 'App\Models\Asset\PostStatus')
@inject('tag', 'App\Models\Taxonomy\Tag')

@php
 $link = $link ?? null;
@endphp

@section('main-classes', 'edit posts-edit')

@section('main')

<h1 class="h2">{{__(isset($link) ? 'Edit Link Note' : 'Create Link Note')}}</h1>

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

<form method="post" action="{{isset($link) ? route('admin.linkNotes.update', [$link->id]) : route('admin.linkNotes.store')}}">
  <input type="hidden" name="_method" value="{{isset($link) ? 'PUT' : 'POST'}}" />

<div class="form-group">
  <label for="title">{{__('Title')}}</label>
  <input type="text" class="form-control" id="title" name="title" value="{{old('title') ?? $link->title ?? null}}" />
</div>

<div class="form-group">
  <label for="slug">{{__('Slug')}} <small>({{__('Can be generated automatically.')}})</small></label>
  <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug') ?? $link->slug ?? null}}" />
</div>



<div class="form-group">
  <label for="content">{{__('Content')}}</label>
  <textarea class="form-control tinymce-light" name="content" id="content">{{old('content') ?? $link->content ?? null}}</textarea>

</div>

<div class="form-group">
  <label for="summary">{{__('Summary')}} <small>({{__('Can be generated automatically.')}})</small></label>
  <textarea class="form-control" name="summary" id="summary">{{old('summary') ?? $link->summary ?? null}}</textarea>

</div>

<div class="row">

<div class="col-4">
   <div class="form-group">
      <label for="tags">{{__('Tags')}}</label>
      <input type="text" id="tags" class="form-control" name="tags" data-pillfield="{{old('tags') ?? $link->tags ?? null}}" value="" />
    </div>
</div>

<div class="col-4">

      <div class="form-group">
        <label for="published_at">{{__('Published at')}}</label>
        <input type="text" class="form-control" id="published_at" name="published_at" value="{{old('published_at') ?? $link->published_at ?? date('Y-m-d')}}" />
      </div>

</div>
<div class="col-4"> 

      <div class="form-group">
        <label for="asset_status">{{__('Status')}}</label>
        <select id="asset_status" name="asset_status" class="form-control">
          @foreach($linkStatus->all() as $status)
            <option {{old('asset_status') == $status || 
                    (isset($link) && $link->asset_status == $status) ? 'selected' : null}}>{{$status}}</option>
          @endforeach
        </select>
      </div>
 </div><!-- .col -->

</div><!-- .row -->

     <div class="form-group">
      <label for="link_url">{{__('Link URL')}}</label>
      <div class="input-group"> 
        <input type="text" class="form-control" id="link_url" name="meta[link_url]" value="{{old('meta.link_url') ?? (isset($link) ? $link->getMeta('link_url') : null)}}" />
        <div class="input-group-append">       
        <button class="btn btn-secondary link_url_fetch" type="button">
          <span class="spinner-border spinner-border-sm" role="status">
               <span class="sr-only">Loading...</span>
          </span> {{__('Fetch')}}
         </button>
        </div> 
        <div class="invalid-feedback">
          {{__('Fethcing of the url failed!')}}
        </div>
       <div class="valid-feedback">
            {{__('The url was fetched successfuly.')}}
        </div>
      </div>
    </div>

<div class="row">

<div class="col-5">
  <div class="photo">
    <button type="button" class="btn btn-secondary" data-media-field="photo_id" data-media-value="{{old('photo_id') ?? $link->photo ?? null}}">{{__('Add a photo')}}</button>
  </div>
</div>



<div class="col-7">
   



    <div class="form-group">
        <label for="title">{{__('Link Title')}}</label>
        <input type="text" class="form-control" id="link_title" name="meta[link_title]" value="{{old('meta.link_title') ?? (isset($link) ? $link->getMeta('link_title') : null)}}" />
    </div>

    <div class="form-group">
        <label for="publiher">{{__('Publisher')}}</label>
        <input type="text" class="form-control" id="publisher" name="meta[publisher]" value="{{old('meta.publisher') ?? (isset($link) ? $link->getMeta('publisher') : null)}}" />
    </div>

    <div class="form-group">
      <label for="tags">{{__('Link Description')}}</label>
      <input type="text" id="link_desc" class="form-control" name="meta[link_desc]" value="{{old('meta.link_desc') ?? (isset($link) ? $link->getMeta('link_desc') : null)}}" />
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