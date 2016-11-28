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
use App\Api\V1\Transformers\CountyTransformerIncidentsPerCounty;
use App\Precinct;
use Illuminate\Support\Facades\Input;
use App\Api\V1\Transformers\PrecinctTransformerIncidentsPerPrecinct;
use Illuminate\Support\Facades\DB;
use App\Api\V1\Transformers\CountyTransformerIncidentsPerCountyOpening;
use App\Api\V1\Transformers\CountyTransformerIncidentsPerCountyCounting;
use App\Api\V1\Transformers\PrecinctTransformerIncidentsPerPrecinctOpening;
use App\Api\V1\Transformers\PrecinctTransformerIncidentsTypePerPrecinct;
use App\IncidentType;

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
		return response()->json(['data' => ['label' => 'observers', 'value' => $observers->count()]]);
	}
	/**
	 * Get incidents number per county.
	 */
	public function incidentsPerCounty()
	{
		$counties = County::get();
		$countyTransformerIPC = new CountyTransformerIncidentsPerCounty();
		
		return response()->json(['data' => $countyTransformerIPC->transformCollection($counties->all())]);
	}
	
	/**
	 * Get incidents total.
	 */
	public function incidentsTotal()
	{
		$total = Incident::count();
		
		return response()->json(['data' => ['label' => 'incidents', 'value' => $total]]);
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
	/**
	 * Get the number of incidents per precinct.
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function incidentsPerPrecinct() {
		$limit = Input::get('limit') ?: 20;
		$limit = min($limit, 200);
		
		$precincts = Precinct::select(DB::raw('precincts.*, count(*) as `aggregate`'))
		->join('incidents', 'precincts.id', '=', 'incidents.precinct_id')
		->groupBy('precinct_id')
		->orderBy('aggregate', 'desc')
		->paginate($limit);
		
		$precinctTransformerIPP = new PrecinctTransformerIncidentsPerPrecinct();
		
		return response()->json([
				'data' => $precinctTransformerIPP->transformCollection($precincts->all()),
				'paginator' => $this->getPaginator($precincts)
		], 200);
	}
	
	/**
	 * Get the number of incindets for opening per county.
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function incidentsOpeningPerCounty() {
		$counties = County::get();
		$countyTransformerIPCO = new CountyTransformerIncidentsPerCountyOpening();
		
		return response()->json(['data' => $countyTransformerIPCO->transformCollection($counties->all())]);
	}
	
	/**
	 * Get the number of incindets for opening per precinct.
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function incidentsOpeningPerPrecinct() {
		return $this->getIncidentsByType('OPN');
	}
	
	/**
	 * Get the number of incindets for counting per county.
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function incidentsCountingPerCounty() {
		$counties = County::get();
		$countyTransformerIPCC = new CountyTransformerIncidentsPerCountyCounting();
	
		return response()->json(['data' => $countyTransformerIPCC->transformCollection($counties->all())]);
	}
	
	/**
	 * Get the number of incindets for counting per precinct.
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function incidentsCountingPerPrecinct() {
		return $this->getIncidentsByType('CNT');
	}
	
	private function getIncidentsByType($type) {
		$limit = Input::get('limit') ?: 20;
		$limit = min($limit, 200);
		
		$precincts = Precinct::select(DB::raw('precincts.*, count(*) as `aggregate`'))
		->where('incidents.incident_type_id', $this->getIncidentTypeId($type))
		->join('incidents', 'precincts.id', '=', 'incidents.precinct_id')
		->groupBy('precinct_id')
		->orderBy('aggregate', 'desc')
		->paginate($limit);
		
		$precinctTransformerITPP = new PrecinctTransformerIncidentsTypePerPrecinct();
		
		return response()->json([
				'data' => $precinctTransformerITPP->transformCollection($precincts->all()),
				'paginator' => $this->getPaginator($precincts)
		], 200);
	}
	
	private function getIncidentTypeId($typeCode) {
		$type = IncidentType::where('code', $typeCode)->first();
		return $type->id;
	}
	
	private function getPaginator($incidents)
	{
		return [
				'total' => $incidents->total(),
				'currentPage' => $incidents->currentPage(),
				'lastPage' => $incidents->lastPage(),
				'limit' => $incidents->perPage(),
				'previousPage' => $incidents->previousPageUrl(),
				'nextPage' => $incidents->nextPageUrl()
		];
	}
	
}
