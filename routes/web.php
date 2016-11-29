<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
	if (Auth::guest()){
    return view('auth.login');
    }
    else{
    return view('home');
    }
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
	Route::get('/home', 'HomeController@index');

	/**
	 * Missing Form Controller resource
	 */
	Route::resource('missings','MissingsController');
	Route::patch('missings/status/{missing}', 'MissingsController@status');

	/**
	 * Sapuser Form controller resource
	 */
	Route::resource('sapusers','SapusersController');
	Route::patch('sapusers/status/{sapuser}', 'SapusersController@status');

	/**
	 * Missing Approvers Controller setup
	 */
	Route::get('missings/approver/create/{id}', 'MissingApproversControllers@create');
	Route::post('missings/approver/{id}', 'MissingApproversControllers@store');

	/**
	 * Missing Functional Controller setup
	 */
	Route::resource('missings/functional', 'MissingFunctionalsContoller', 
	[ 'only' => ['index', 'update', 'destroy'] ]);
	Route::get('missings/functional/create/{id}', 'MissingFunctionalsContoller@create');
	Route::post('missings/functional/{id}', 'MissingFunctionalsContoller@store');

	/**
	 * Missing Functional Controller setup
	 */
	Route::resource('missings/management', 'MissingManagementsController', 
	[ 'only' => ['index', 'update', 'destroy'] ]);
	Route::get('missings/management/create/{id}', 'MissingManagementsController@create');
	Route::post('missings/management/{id}', 'MissingManagementsController@store');

	/**
	 * Sapuser approver controller setup
	 */
	Route::get('sapusers/approver/create/{id}', 'SapuserApproversController@create');
	Route::post('sapusers/approver/{id}', 'SapuserApproversController@store');

	/**
	 * Sapuser approver functional controller setup
	 */
	Route::get('sapusers/functional/create/{id}', 'SapuserFunctionalsController@create');
	Route::post('sapusers/functional/{id}', 'SapuserFunctionalsController@store');
	/**
	 * Sapuser management controller setup
	 */
	Route::get('sapusers/management/create/{id}', 'SapuserManagementsController@create');
	Route::post('sapusers/management/{id}', 'SapuserManagementsController@store');	






	Route::resource('users','UserController');
	Route::resource('roles','RoleController');

});