<?php 

Route::get('admin/login', 'tcg\voyager\VoyagerController@login')->middleware('web');
Route::post('admin/login', 'tcg\voyager\VoyagerController@postLogin')->middleware('web');

Route::group(['middleware' => ['web', 'admin.user']], function () {
	
	// Main Admin and Logout Route
	Route::get('/admin', 'tcg\voyager\VoyagerController@index');
	Route::get('/admin/logout', 'tcg\voyager\VoyagerController@logout');

	// Builder Resourceful routes
	Route::resource('/admin/builder', 'tcg\voyager\controllers\VoyagerBuilderController');

	// Builder Route for creating a new crud POST
	Route::post('/admin/builder/create', 'tcg\voyager\controllers\VoyagerBuilderController@create');


	if(Schema::hasTable('data_types')):
		foreach(TCG\Voyager\Models\DataType::all() as $dataTypes):
			Route::resource('admin/' . $dataTypes->name, 'tcg\voyager\controllers\VoyagerBreadController');
		endforeach;
	endif;

	Route::get('mkdir', function(){
		
	});


	Route::get('/admin/database', 'tcg\voyager\controllers\VoyagerDevToolsController@database');
	Route::resource('admin/users', 'tcg\voyager\controllers\VoyagerUserController');
	Route::resource('admin/roles', 'tcg\voyager\controllers\VoyagerRoleController');
});