@extends('voyager::master')

@section('page_header')
	Dashboard
@stop

@section('content')

    <?php $arr = DB::select('SHOW TABLES'); ?>
    @foreach($arr as $a)
        <?php echo current($a); ?><br />
    @endforeach
    

@stop