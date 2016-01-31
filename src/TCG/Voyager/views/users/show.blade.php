@extends('voyager::master')

@section('page_header')
	<i class="fa fa-user"></i> {{ $user->name }}
@stop

@section('content')
  {{ $user->name }}
  {{ $user->email }}
  {{ $user->created_at }}
@stop