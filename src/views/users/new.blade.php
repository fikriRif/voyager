@extends('voyager::master')

@section('page_header')
	<i class="fa fa-user"></i> New User
@stop

@section('content')
<div class="row">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-plus-circle"></i> Add a New User</h3>
    </div>

    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{ url('/admin/users') }}" method="POST">
      <div class="box-body">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" name="name" placeholder="Name">
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="text" class="form-control" name="email" placeholder="Email Address">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password">
        </div>
      </div>
      <!-- /.box-body -->
      <!-- CSRF TOKEN -->
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</div>
@stop