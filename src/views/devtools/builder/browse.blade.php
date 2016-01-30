@extends('voyager::master')

@section('css')
    <link rel="stylesheet" href="{{ VOYAGER_ASSETS_PATH }}/css/builder.css">
@stop

@section('page_header')

    @if(Session::has('message'))
      <div class="alert callout alert-{{ Session::get('alert-class', 'info') }}"><i class="fa fa-{{ Session::get('alert-icon', 'info-circle') }}"></i> {{ Session::get('message') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
    @endif

	<i class="fa fa-anchor"></i> Voyager BREAD Builder
@stop

@section('content')
    
    <div class="row">
    	<p><strong>What is the builder?</strong></p>
        <h6>Using the Voyager Builder you can easily create BREAD (Browse, Read, Edit, Add, & Delete) Generators for any row in your database.<h6>

        <?php $dataTypes = TCG\Voyager\Models\DataType::all(); ?>
        <?php $dataTypeNames = array(); ?>
        @foreach($dataTypes as $type)
            <?php array_push($dataTypeNames, $type->name); ?>
        @endforeach

        <?php $arr = DB::select('SHOW TABLES'); ?>
        @foreach($arr as $a)
            <?php $table = current($a); ?>
                @if($table != 'data_types' && $table != 'data_rows' && $table != 'migrations')
                    <?php $active = in_array($table, $dataTypeNames); ?>
                    <div class="db_row @if($active){{ 'bread_active' }}@endif">
                        <h4><i class="fa fa-database"></i> {{ $table }}</h4>
                            <div class="actions">
                                @if($active)
                                    <?php $activeDataType = TCG\Voyager\Models\DataType::where('name', '=', $table)->first(); ?>
                                    <a class="btn btn-sm btn-default edit" href="/admin/builder/{{ $activeDataType->id }}/edit"><i class="fa fa-edit"></i> Edit</a><div class="btn btn-sm btn-danger delete" data-id="{{ $activeDataType->id }}" data-name="{{ $table }}"><i class="fa fa-trash-o"></i> Remove BREAD</div>
                                @else
                                    <form action="/admin/builder/create" method="POST">
                                        <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                        <input type="hidden" value="{{ $table }}" name="table">
                                        <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-plus-circle"></i> Create BREAD for this table</button>
                                    </form>
                                @endif
                       
                            </div>
                        <div class="clear"></div>
                    </div>
                @endif
        @endforeach

    </div>


    <div class="modal modal-danger fade" tabindex="-1" id="delete_builder_modal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-trash-o"></i> Are you sure you want to delete the BREAD for the <span id="delete_builder_name"></span> table?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
            <form action="/admin/builder" id="delete_builder_form" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-outline" value="Yes, remove the BREAD">
            </form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@stop

@section('javascript')

    <script>
        $('.actions').on('click', '.delete', function(e){
        id = $(e.target).data('id');
        name = $(e.target).data('name');

        $('#delete_builder_name').text(name);
        $('#delete_builder_form').attr('action', '/admin/builder/' + id);
        $('#delete_builder_modal').modal('show');
      });
    </script>

@stop