<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use App\Api\V1\Transformers\CountyTransformer;
use App\County;
use App\Incident;
use App\User;

class ReportingController extends Controller
{
	use Helpers;
	
	protected $countyTransformer;
	
	function __construct(CountyTransformer $countyTransformer)
	{
		$this->countyTransformer = $countyTransformer;
	}
	
	public function observersTotal() {
		$observers = User::where('role', '!=', 'admin')->get();
		return response()->json(['data' => ['observers' => $observers->count()]]);
	}
	/**
	 * Get incidents number per county.
	 */
	public function incidentsPerCounty()
	{
		$counties = County::all();
		
		return response()->json(['data' => ['counties' => $this->countyTransformer->transformCollection($counties->all())]]);
	}
	
	/**
	 * Get incidents total.
	 */
	public function incidentsTotal()
	{
		$total = Incident::count();
		
		return response()->json(['data' => $total]);
	}
	
	/**
	 * Get most incidents county.
	 */
	public function mostIncidentsCounty()
	{
		$most = County::with('incidents')->get()->sortBy(function($county)
					{
					    return $county->incidents->count();
					})->last();
	
		return response()->json(['data' => $most->name]);
	}
	
}
