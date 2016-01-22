@extends('voyager::master')

@section('page_header')
	<i class="fa fa-users"></i> New Role
@stop

@section('content')
<div class="row">

    	<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-plus-circle"></i> Add a New Role</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="This is any kind of unique name that will help you remember what they have access to. The display below is what users will typically see."></i></label>
                  <input type="text" class="form-control" name="name" placeholder="Enter the name of the role (ex. admin, basic...)">
                </div>
                <div class="form-group">
                  <label for="display_name">Display Name <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="Display name is typically what is shown to other users as to what type of user they are."></i></label>
                  <input type="text" class="form-control" name="display_name" placeholder="Display Name">
                </div>
                <div class="form-group">
                  <label for="display_name">Description <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="Give a brief description for this user role. Maybe why they are needed or what they will have permission to access."></i></label>
                  <textarea name="description" class="form-control" placeholder="Description"></textarea>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
       </div>

</div>
@stop