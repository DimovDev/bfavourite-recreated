@extends('admin/layouts/main')
@inject('userRole', 'App\UserRole')
@inject('userStatus', 'App\UserStatus')

@section('main-classes', 'edit users-edit')

@section('main')

<h1 class="h2">{{__(isset($user) ? 'Edit User' : 'Create User')}}</h1>

@if($errors->any())
 <div class="alert alert-danger">
   <ul>
     @foreach($errors->all() as $error) 
      <li>{{$error}}</li>
     @endforeach
   </ul>
 </div>
@endif

<form method="post" action="{{isset($user) ? route('admin.users.update', [$user->id]) : route('admin.users.store')}}">
  <input type="hidden" name="_method" value="{{isset($user) ? 'PUT' : 'POST'}}" />

<div class="row">

  <div class="col-3 mr-3">
    <div class="photo">
      <button type="button" class="btn btn-secondary" data-media-field="photo" data-media-value="{{old('photo') ?? $user->photo ?? null}}">{{__('Add a photo')}}</button>
    </div>
  </div>

  <div class="col-8">

      <div class="form-group">
        <label for="name">{{__('Name')}}</label>
        <input type="text" class="form-control" id="name" name="name" value="{{old('name') ?? $user->name ?? null}}" />
      </div>

      <div class="form-group">
        <label for="email">{{__('Email')}}</label>
        <input type="text" class="form-control" id="email" name="email" value="{{old('email') ?? $user->email ?? null}}" />
      </div>
      
      <div class="form-group">
        <label for="role">{{__('Role')}}</label>
        <select id="role" name="role" class="form-control">
          @foreach($userRole->all() as $role)
            <option {{$role == old('role') ? 'selected' : null}}>{{$role}}</option>
          @endforeach
        </select>
      </div>      


  </div><!-- .col -->
</div><!-- .row -->




<div class="form-group">
  <label for="password">{{__('Password')}}</label>
  <input type="password" class="form-control" id="password" name="password" value="" />
</div>

<div class="form-group">
  <label for="password_confirmation">{{__('Confirm Your Password')}}</label>
  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="" />
</div>

<div class="form-group">
  <label for="user_status">{{__('Status')}}</label>
  <select id="user_status" name="user_status" class="form-control">
    @foreach($userStatus->all() as $status)
      <option {{old('user_status') || 
                  (isset($user) && $user->user_status == $status) ? 'selected' : null}}>{{$status}}</option>

      
    @endforeach
  </select>
</div>

<button type="submit" class="btn btn-primary">{{__('Save')}}</button>

@csrf

</form>


@endsection