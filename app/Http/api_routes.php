<?php
	
$api = app('Dingo\Api\Routing\Router');

$api->version('v1',  ['middleware' => 'cors'], function ($api) {

	$api->post('auth/login', 'App\Api\V1\Controllers\AuthController@login');
	$api->post('auth/signup', 'App\Api\V1\Controllers\AuthController@signup');
	$api->post('auth/recovery', 'App\Api\V1\Controllers\AuthController@recovery');
	$api->post('auth/reset', 'App\Api\V1\Controllers\AuthController@reset');

	//Protected routes
	$api->group(['middleware' => 'api.auth'], function ($api) {
		
		//Events
		$api->get('incidents', 'App\Api\V1\Controllers\IncidentController@index');
		$api->get('incidents/{incidentId}', 'App\Api\V1\Controllers\IncidentController@show');
	});

	//Public routes
	$api->get('check', 'App\Api\V1\Controllers\PublicController@check');
});
