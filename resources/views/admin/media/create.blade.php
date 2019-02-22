@extends('admin/layouts/main')

@inject('postStatus', 'App\Models\Asset\PostStatus')

@section('main')

<h1 class="h2">{{__(' Upload Media')}}</h1>
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

<form method="post" action="{{route('admin.media.store')}}" enctype="multipart/form-data">


<div class="form-row">
<div class="col-6">
  <div class="custom-file">
    <input type="hidden" name="_method" value="POST" />
    <input type="file" class="custom-file-input" id="customFile" name="file" />
    <label class="custom-file-label" for="customFile">Choose file</label>
  </div>
 </div>
<div class="col-2">
 <button type="submit" class="btn btn-primary">{{__('Upload')}}</button>
 @csrf
</div>
</div>


</form>


@endsection