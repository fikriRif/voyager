@extends('voyager::master')

@section('page_header')
	<i class="fa fa-database"></i> @if(isset($dataType->id)){{ 'Edit BREAD for ' . $dataType->name . ' table' }}@elseif(isset($table)){{ 'Create BREAD for ' . $table . ' table' }}@endif
@stop

@section('content')
  
@if(isset($dataType->name))
  <?php $table = $dataType->name ?>
@endif
  

<?php $tableData = DB::select("DESCRIBE ${table}"); ?>

<div class="row">

  <form role="form" action="@if(isset($dataType->id)){{ url('/admin/builder/' . $dataType->id) }}@else{{ url('/admin/builder') }}@endif" method="POST">
    
      <table id="users" class="table table-bordered">
        <thead>
          <tr>
            <th>Field</th>
            <th>Field Info</th>
            <th>Visibility</th>
            <th>Input Type</th>
            <th>Display Name</th>
            <th>Optional Details</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tableData as $data)
            @if(isset($dataType->id))
              <?php $dataRow = TCG\Voyager\Models\DataRow::where('data_type_id', '=', $dataType->id)->where('field', '=', $data->Field)->first(); ?>
            @endif
            <tr>
              <td><h4><strong>{{ $data->Field }}</strong></h4></td>
              <td>
                  <strong>Type:</strong> <span>{{ $data->Type }}</span><br />
                  <strong>Key:</strong> <span>{{ $data->Key }}</span><br />
                  <strong>Required:</strong> 
                  @if($data->Null == "NO")
                    <span>Yes</span>
                    <input type="hidden" value="1" name="field_required_{{ $data->Field }}" checked="checked">
                  @else
                    <span>No</span>
                    <input type="hidden" value="0" name="field_required_{{ $data->Field }}">
                  @endif
              </td>
              <td>
                <input type="checkbox" name="field_browse_{{ $data->Field }}" @if(isset($dataRow->browse) && $dataRow->browse){{ 'checked="checked"' }}@elseif($data->Key == 'PRI')@elseif($data->Type == 'timestamp' && $data->Field == 'updated_at')@elseif(!isset($dataRow->browse)){{ 'checked="checked"' }}@endif> Browse<br />
                <input type="checkbox" name="field_read_{{ $data->Field }}" @if(isset($dataRow->read) && $dataRow->read){{ 'checked="checked"' }}@elseif($data->Key == 'PRI')@elseif($data->Type == 'timestamp' && $data->Field == 'updated_at')@elseif(!isset($dataRow->read)){{ 'checked="checked"' }}@endif> Read<br />
                <input type="checkbox" name="field_edit_{{ $data->Field }}" @if(isset($dataRow->edit) && $dataRow->edit){{ 'checked="checked"' }}@elseif($data->Key == 'PRI')@elseif($data->Type == 'timestamp' && $data->Field == 'updated_at')@elseif(!isset($dataRow->edit)){{ 'checked="checked"' }}@endif> Edit<br />
                <input type="checkbox" name="field_add_{{ $data->Field }}" @if(isset($dataRow->add) && $dataRow->add){{ 'checked="checked"' }}@elseif($data->Key == 'PRI')@elseif($data->Type == 'timestamp' && $data->Field == 'created_at')@elseif($data->Type == 'timestamp' && $data->Field == 'updated_at')@elseif(!isset($dataRow->add)){{ 'checked="checked"' }}@endif> Add<br />
                <input type="checkbox" name="field_delete_{{ $data->Field }}" @if(isset($dataRow->delete) && $dataRow->delete){{ 'checked="checked"' }}@elseif($data->Key == 'PRI')@elseif($data->Type == 'timestamp' && $data->Field == 'updated_at')@elseif(!isset($dataRow->delete)){{ 'checked="checked"' }}@endif> Delete<br />
              </td>
              <input type="hidden" name="field_{{ $data->Field }}" value="{{ $data->Field }}">
              <td>
                @if($data->Key == 'PRI')
                  <p>Primary Key</p>
                  <input type="hidden" value="PRI" name="field_input_type_{{ $data->Field }}">
                @elseif($data->Type == 'timestamp')
                  <p>Timestamp</p>
                  <input type="hidden" value="timestamp" name="field_input_type_{{ $data->Field }}">
                @else
                  <select name="field_input_type_{{ $data->Field }}">
                    <option value="text" @if(isset($dataRow->type) && $dataRow->type == 'text'){{ 'selected' }}@endif>Text Box</option>
                    <option value="text_area" @if(isset($dataRow->type) && $dataRow->type == 'text_area'){{ 'selected' }}@endif>Text Area</option>
                    <option value="rich_text_box" @if(isset($dataRow->type) && $dataRow->type == 'rich_text_box'){{ 'selected' }}@endif>Rich Textbox</option>
                    <option value="password" @if(isset($dataRow->type) && $dataRow->type == 'password'){{ 'selected' }}@endif>Password</option>
                    <option value="hidden" @if(isset($dataRow->type) && $dataRow->type == 'hidden'){{ 'selected' }}@endif>Hidden</option>
                    <option value="checkbox" @if(isset($dataRow->type) && $dataRow->type == 'checkbox'){{ 'selected' }}@endif>Check Box</option>
                    <option value="radio_btn" @if(isset($dataRow->type) && $dataRow->type == 'radio_btn'){{ 'selected' }}@endif>Radio Button</option>
                    <option value="radio_group" @if(isset($dataRow->type) && $dataRow->type == 'radio_group'){{ 'selected' }}@endif>Radio Button Group</option>
                    <option value="select_dropdown" @if(isset($dataRow->type) && $dataRow->type == 'select_dropdown'){{ 'selected' }}@endif>Select Dropdown</option>
                    <option value="file" @if(isset($dataRow->type) && $dataRow->type == 'file'){{ 'selected' }}@endif>File</option>
                    <option value="image" @if(isset($dataRow->type) && $dataRow->type == 'image'){{ 'selected' }}@endif>Image</option>
                  </select>
                @endif

              </td>
              <td><input type="text" class="form-control" value="@if(isset($dataRow->display_name)){{ $dataRow->display_name }}@else{{ $data->Field }}@endif" name="field_display_name_{{ $data->Field }}"></td>
              <td><textarea class="form-control" name="field_details_{{ $data->Field }}">@if(isset($dataRow->details)){{ $dataRow->details }}@endif</textarea></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    
      <div class="box box-primary">
        <div class="box-header with-border">
          {{ ucfirst($table) }} BREAD info
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
              <label for="email">Display Name (Singular)</label>
              <input type="text" class="form-control" name="display_name_singular" placeholder="Display Name (Singular)" value="@if(isset($dataType->display_name_singular)){{ $dataType->display_name_singular }}@endif">
            </div>
            <div class="form-group">
              <label for="email">Display Name (Plural)</label>
              <input type="text" class="form-control" name="display_name_plural" placeholder="Display Name (Plural)" value="@if(isset($dataType->display_name_plural)){{ $dataType->display_name_plural }}@endif">
            </div>
            <div class="form-group">
              <label for="email">Icon (optional) Use fonts from <a href="https://fortawesome.github.io/Font-Awesome/icons/" target="_blank">FontAwesome</a></label>
              <input type="text" class="form-control" name="icon" placeholder="Icon to use for this Table" value="@if(isset($dataType->icon)){{ $dataType->icon }}@endif">
            </div>
            <div class="form-group">
              <label for="email">Model Name (ex. \App\User, if left empty will try and use the table name)</label>
              <input type="text" class="form-control" name="model_name" placeholder="Model Class Name" value="@if(isset($dataType->model_name)){{ $dataType->model_name }}@endif">
            </div>
            <div class="form-group">
              <label for="email">Description</label>
              <textarea class="form-control" name="description" placeholder="Description">@if(isset($dataType->description)){{ $dataType->description }}@endif</textarea>
            </div>
          </div>
          <!-- /.box-body -->
          @if(isset($dataType->id))
            <input type="hidden" value="{{ $dataType->id }}" name="id">
            <input type="hidden" value="PUT" name="_method">
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