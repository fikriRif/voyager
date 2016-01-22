<?php 

Route::get('/admin/login', 'tcg\voyager\VoyagerController@login')->middleware('web');
Route::post('admin/login', 'tcg\voyager\VoyagerController@postLogin')->middleware('web');

Route::group(['middleware' => ['web', 'admin.user']], function () {
	Route::get('/admin', 'tcg\voyager\VoyagerController@index');
	Route::resource('admin/users', 'tcg\voyager\controllers\VoyagerUserController');
	Route::resource('admin/roles', 'tcg\voyager\controllers\VoyagerRoleController');
});