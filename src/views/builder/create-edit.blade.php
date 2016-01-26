@extends('voyager::master')

@section('page_header')
	<i class="fa fa-database"></i> @if(isset($dataType->id)){{ 'Edit CRUD for ' . $dataType->name . ' table' }}@elseif(isset($table)){{ 'Create CRUD for ' . $table . ' table' }}@endif
@stop

@section('content')
  
@if(isset($dataType->name))
  <?php $table = $dataType->name ?>
@endif

<?php $tableData = DB::select("DESCRIBE ${table}"); ?>

<div class="row">

  <form role="form" action="@if(isset($dataType->id)){{ url('/admin/builder/' . $$dataType->id) }}@else{{ url('/admin/builder') }}@endif" method="POST">
    <table id="users" class="table table-bordered">
      <thead>
        <tr>
          <th>Field</th>
          <th>Type</th>
          <th>Key</th>
          <th>Required</th>
          <th>Visible</th>
          <th>Input Type</th>
          <th>Optional Details</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tableData as $data)
          <tr>
            <td>{{ $data->Field }}</td>
            <td>{{ $data->Type }}</td>
            <td>{{ $data->Key }}</td>
            <td>@if($data->Null == "NO"){{ 'Yes' }}@else{{ 'No' }}@endif</td>
            <td>
              <input type="checkbox" name="field_show_{{ $data->Field }}" checked="checked">
            </td>
            <input type="hidden" name="field_{{ $data->Field }}" value="{{ $data->Field }}">
            <td>
              <select name="field_input_type_{{ $data->Field }}">
                <option value="text">Text</option>
                <option value="text_area">Text Area</option>
                <option value="rich_text_box">Rich Textbox</option>
                <option value="password">Password</option>
                <option value="hidden">Hidden</option>
                <option value="checkbox">Check Box</option>
                <option value="radio_btn">Radio Button</option>
                <option value="radio_group">Radio Button Group</option>
                <option value="select_dropdown">Select Dropdown</option>
                <option value="file">File</option>
                <option value="image">Image</option>
              </select>

            </td>
            <td><textarea class="form-control" name="field_details_{{ $data->Field }}"></textarea></td>
          </tr>
        @endforeach
      </tbody>
    </table>


    <div class="box box-primary">
      <div class="box-header with-border">
        {{ ucfirst($table) }} CRUD info
      </div>
      <!-- /.box-header -->
      <!-- form start -->
     
        <div class="box-body">
          <div class="form-group">
            <label for="name">Table Name</label>
            <input type="text" class="form-control" readonly name="name" placeholder="Name" value="@if(isset($dataType->name)){{ $dataType->name }}@else{{ $table }}@endif">
          </div>
          <div class="form-group">
            <label for="email">URL Slug (must be unique)</label>
            <input type="text" class="form-control" name="slug" placeholder="URL slug (ex. posts)" value="@if(isset($dataType->slug)){{ $dataType->slug }}@endif">
          </div>
          <div class="form-group">
            <label for="email">Display Name</label>
            <input type="text" class="form-control" name="display_name" placeholder="Display Name" value="@if(isset($dataType->display_name)){{ $dataType->display_name }}@endif">
          </div>
          <div class="form-group">
            <label for="email">Icon (optional) Use fonts from <a href="https://fortawesome.github.io/Font-Awesome/icons/" target="_blank">FontAwesome</a></label>
            <input type="text" class="form-control" name="icon" placeholder="Icon to use for this Table" value="@if(isset($dataType->display_name)){{ $dataType->display_name }}@endif">
          </div>
          <div class="form-group">
            <label for="email">Model Name (ex. \App\User, if left empty will try and use the table name)</label>
            <input type="text" class="form-control" name="model_name" placeholder="Model Class Name" value="@if(isset($dataType->slug)){{ $dataType->slug }}@endif">
          </div>
          <div class="form-group">
            <label for="email">Description</label>
            <textarea class="form-control" name="description" placeholder="Description">@if(isset($dataType->description)){{ $dataType->description }}@endif</textarea>
          </div>
        </div>
        <!-- /.box-body -->
        @if(isset($dataType->id))
          <input type="hidden" value="{{ $dataType->id }}" name="id">
        @endif
        <!-- CSRF TOKEN -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
  </form>
</div>

<?php /*
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
*/ ?>
@stop