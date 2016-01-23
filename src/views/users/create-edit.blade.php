@extends('voyager::master')

@section('page_header')
	<i class="fa fa-user"></i> @if(isset($user->id)){{ 'Edit' }}@else{{ 'New' }}@endif User
@stop

@section('content')
<div class="row">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa @if(isset($user->id)){{ 'fa-edit' }}@else{{ 'fa-plus-circle' }}@endif"></i> @if(isset($user->name)){{ 'Edit User ' . $user->name }}@else{{ 'Add a New User' }}@endif</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="@if(isset($user->id)){{ url('/admin/users/' . $user->id) }}@else{{ url('/admin/users') }}@endif" method="POST">
      <div class="box-body">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" name="name" placeholder="Name" value="@if(isset($user->name)){{ $user->name }}@endif">
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="text" class="form-control" name="email" placeholder="Email Address" value="@if(isset($user->name)){{ $user->email }}@endif">
        </div>
        <div class="form-group">
          <label for="password">Password @if(isset($user->password)){{ ' (Leave blank to keep the original password)' }}@endif"</label>
          <input type="password" class="form-control" name="password">
        </div>
      </div>
      <!-- /.box-body -->
      @if(isset($user->id))
        <input type="hidden" value="{{ $user->id }}" name="id">
      @endif
      <!-- CSRF TOKEN -->
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</div>
@stop