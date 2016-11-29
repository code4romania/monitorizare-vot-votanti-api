<?php
	
$api = app('Dingo\Api\Routing\Router');

$api->version('v1',  ['middleware' => 'cors'], function ($api) {

	$api->post('auth/login', 'App\Api\V1\Controllers\AuthController@login');
	$api->post('auth/signup', 'App\Api\V1\Controllers\AuthController@signup');
	$api->post('auth/recovery', 'App\Api\V1\Controllers\AuthController@recovery');
	$api->post('auth/reset', 'App\Api\V1\Controllers\AuthController@reset');

	//Auth user endpoints
	$api->group(['middleware' => 'api.auth'], function ($api) {
		$api->post('incidents', 'App\Api\V1\Controllers\IncidentController@store');
	});

	//Admin only endpoints
	$api->group(['middleware' => ['api.auth', 'role:admin']], function ($api) {
		$api->put('incidents/{incidentId}/approve', 'App\Api\V1\Controllers\IncidentController@approve');
		$api->put('incidents/{incidentId}/reject', 'App\Api\V1\Controllers\IncidentController@reject');
		$api->delete('incidents/{incidentId}', 'App\Api\V1\Controllers\IncidentController@destroy');
	});

	//Public routes
	$api->get('check', 'App\Api\V1\Controllers\PublicController@check');

	//Location
	$api->get('counties', 'App\Api\V1\Controllers\LocationController@counties');
	$api->get('counties/{countyId}/cities', 'App\Api\V1\Controllers\LocationController@cities');

	//Incidents
	$api->get('incidents', 'App\Api\V1\Controllers\IncidentController@index');
	$api->get('incidents/types', 'App\Api\V1\Controllers\IncidentTypeController@index');
	$api->get('incidents/{incidentId}', 'App\Api\V1\Controllers\IncidentController@show');
	
	//Reporting routes
	$api->get('statistici/numar-observatori', 		   'App\Api\V1\Controllers\ReportingController@observersTotal');
	$api->get('statistici/sesizari', 				   'App\Api\V1\Controllers\ReportingController@incidentsTotal');
	$api->get('statistici/sesizari-judete', 		   'App\Api\V1\Controllers\ReportingController@incidentsPerCounty');
	$api->get('statistici/sesizari-judet-top', 		   'App\Api\V1\Controllers\ReportingController@mostIncidentsCounty');
	$api->get('statistici/sesizari-sectii', 		   'App\Api\V1\Controllers\ReportingController@incidentsPerPrecinct');
	$api->get('statistici/sesizari-deschidere-judete', 'App\Api\V1\Controllers\ReportingController@incidentsOpeningPerCounty');
	$api->get('statistici/sesizari-deschidere-sectii', 'App\Api\V1\Controllers\ReportingController@incidentsOpeningPerPrecinct');
	$api->get('statistici/sesizari-numarare-judete',   'App\Api\V1\Controllers\ReportingController@incidentsCountingPerCounty');
	$api->get('statistici/sesizari-numarare-sectii',   'App\Api\V1\Controllers\ReportingController@incidentsCountingPerPrecinct');
	$api->get('statistici/sesizari-tip-judete',   	   'App\Api\V1\Controllers\ReportingController@incidentTypesPerCountyTops');
});
