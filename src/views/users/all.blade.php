@extends('voyager::master')

@section('css')
	<!-- DataTables -->
    <link rel="stylesheet" href="{{ VOYAGER_ASSETS_PATH }}/plugins/datatables/dataTables.bootstrap.css">
@stop

@section('page_header')
	<i class="fa fa-user"></i> Users <a href="/admin/users/create" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New</a>
@stop

@section('content')
	<div class="row">
		<table id="example2" class="table table-bordered table-hover">
	        <thead>
	          <tr>
	          	<th>Name</th>
	          	<th>Email</th>
	          	<th>Created</th>
	          	<th>Actions</th>
	          </tr>
	        </thead>
	        <tbody>
	       		@foreach($users as $user)
	          		<tr>
	            		<td>{{ $user->name }}</td>
	            		<td>{{ $user->email }}</td>
	            		<td>{{ \Carbon\Carbon::parse($user->created_at)->format('F jS, Y h:i A') }}</td>
	            		<td class="no-sort"><a href="#_" class="btn-sm btn-danger pull-right" style="margin-left:5px;"><i class="fa fa-trash"></i> Delete</a><a href="#_" class="btn-sm btn-primary pull-right"><i class="fa fa-edit"></i> Edit</a></td>
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
          "autoWidth": false,
          "aoColumnDefs": [
	          { 'bSortable': false, 'aTargets': [ -1 ] }
	       ]
        });
      });
    </script>
@stop