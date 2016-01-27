@extends('voyager::master')

@section('css')
    <link rel="stylesheet" href="{{ VOYAGER_ASSETS_PATH }}/css/builder.css">
@stop

@section('page_header')
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
                                    <a class="btn btn-sm btn-default edit" href="/admin/builder/{{ $activeDataType->id }}/edit"><i class="fa fa-edit"></i> Edit</a><div class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Remove BREAD</div>
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

@stop