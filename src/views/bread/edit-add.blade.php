@extends('voyager::master')

@section('page_header')
	<i class="fa fa-{{ $dataType->icon }}"></i> New {{ $dataType->display_name_singular }}
@stop

@section('content')
<div class="row">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-plus-circle"></i> Add New {{ $dataType->display_name_singular }}</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="@if(isset($user->id)){{ url('/admin/users/' . $user->id) }}@else{{ url('/admin/users') }}@endif" method="POST">
      <div class="box-body">
        
        @foreach($dataType->addRows as $row)
          <div class="form-group">
            <label for="name">{{ $row->display_name }}</label>
            
            @if($row->type == "text")
              <input type="text" class="form-control" name="{{ $row->field }}" placeholder="{{ $row->display_name }}">
            @elseif($row->type == "text_area")
              <textarea class="form-control" name="{{ $row->field }}"></textarea>
            @elseif($row->type == "rich_text_box")
              <textarea class="form-control richTextBox" name="{{ $row->field }}"></textarea>
            @elseif($row->type == "image" || $row->type == "file")
              <input type="file" name="{{ $row->field }}">
            @elseif($row->type == "select_dropdown")
              <?php $options = json_decode($row->details); ?>
              <select class="form-control">
                @foreach($options->dropdown as $key => $option)
                  <option value="{{ $key }}">{{ $option }}</option>
                @endforeach
              </select>

            @endif

          </div>
        @endforeach
        

      </div>
      
      <!-- CSRF TOKEN -->
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</div>
@stop

@section('javascript')
  <script src="{{ VOYAGER_ASSETS_PATH }}/plugins/tinymce/tinymce.min.js"></script>
  <script>
  tinymce.init({ 
    selector:'textarea.richTextBox',
    skin: 'voyager' 
  });
  </script>
@stop