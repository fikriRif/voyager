@extends('voyager::master')

@section('page_header')
	<div id="dashboard_bg">
        <p><i class="fa fa-ship"></i> Shipboard</p>
    </div>
    <div id="dashboard_top_padding"></div>
@stop

@section('content')

    <div class="row">
        <img src="{{ VOYAGER_ASSETS_PATH }}/images/admin-db-bg.png" style="width:100%; height:auto;">
    </div>
    <!--div class="row">
    	<div class="col-md-3 padding-20 widget">
    		<i class="fa fa-user"></i>
    		<h1>304</h1>
    		<span class="margin-left-15 font-weight-400">Users</span>
    		<a href="#" class="label pull-right">All Users</a>
    		<a href="#" class="label pull-right">New Users</a>
    	</div>
    	<div class="col-md-3">asdf</div>
    	<div class="col-md-3">asdf</div>
    	<div class="col-md-3">asdf</div>
    </div-->

@stop