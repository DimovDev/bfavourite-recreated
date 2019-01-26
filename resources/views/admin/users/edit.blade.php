@extends('admin/layouts/main')
@inject('userRole', 'App\UserRole')
@inject('userStatus', 'App\UserStatus')

@section('content')

<h1 class="h2">{{__('Create User')}}</h1>

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
      <option {{$status == old('user_status') ? 'selected' : null}}>{{$status}}</option>
    @endforeach
  </select>
</div>

<button type="submit" class="btn btn-primary">{{__('Save')}}</button>

@csrf

</form>


@endsection