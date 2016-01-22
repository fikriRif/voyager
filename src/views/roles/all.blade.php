@extends('voyager::master')

@section('css')
	<!-- DataTables -->
    <link rel="stylesheet" href="{{ VOYAGER_ASSETS_PATH }}/plugins/datatables/dataTables.bootstrap.css">
@stop

@section('page_header')
	<i class="fa fa-users"></i> Roles <a href="/admin/roles/create" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New</a>
@stop

@section('content')
	<div class="row">
		<table id="example2" class="table table-bordered table-hover">
	        <thead>
	          <tr>
	          	<th>Name</th>
	          	<th>Display Name</th>
	          	<th>Description</th>
	          	<th>Actions</th>
	          </tr>
	        </thead>
	        <tbody>
	       		@foreach($roles as $role)
	          		<tr>
	            		<td>{{ $role->name }}</td>
	            		<td>{{ $role->display_name }}</td>
	            		<td>{{ $role->description }}</td>
	            		<td><a href="#_" class="btn-sm btn-danger pull-right" style="margin-left:5px;"><i class="fa fa-trash"></i> Delete</a><a href="#_" class="btn-sm btn-primary pull-right"><i class="fa fa-edit"></i> Edit</a></td>
	          		</tr>
	          	@endforeach
	        </tbody>
	      </table>
    </div>
@stop

@section('javascript')
	<!-- DataTables -->
    <script src="{{ VOYAGER_ASSETS_PATH }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ VOYAGER_ASSETS_PATH }}/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
@stop