<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Dingo\Api\Routing\Helpers;
use Dingo\Api\Exception\StoreResourceFailedException;
use App\Http\Requests\StoreIncidentRequest;
use App\Http\Controllers\Controller;
use App\Api\V1\Transformers\IncidentTransformer;

use App\Incident;
use App\User;

use WebSocket\Client;

/**
 * @SWG\Get(
 *     path="/api/incidents",
 *     summary="Fetch incidents",
 *     tags={"Incidents"},
 *     description="Fetch tags filtered by state.",
 *     operationId="findPetsByTags",
 *     consumes={"application/json"},
 *     produces={"application/json"},
 *     @SWG\Parameter(
 *         name="tags",
 *         in="query",
 *         description="Tags to filter by",
 *         required=false,
 *         type="array",
 *         @SWG\Items(type="string"),
 *         collectionFormat="multi"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="successful operation",
 *         @SWG\Schema(
 *             type="array",
 *             @SWG\Items(ref="#/definitions/Incident")
 *         ),
 *     ),
 *     @SWG\Response(
 *         response="400",
 *         description="Invalid tag value",
 *     ),
 *     security={
 *         {
 *             "monitorizare_auth": {"read:incidents"}
 *         }
 *     }
 * )
 */
class IncidentController extends Controller
{
    use Helpers;

    protected $incidentTransformer;

    function __construct(IncidentTransformer $incidentTransformer)
    {
        $this->incidentTransformer = $incidentTransformer;
    }

    public function index()
    {
        $limit = Input::get('limit') ?: 20;
        $limit = min($limit, 200);
        $status = Input::get('status')  ?: ['Approved'];

        $incidents = Incident::with('type')
            ->with('county')
            ->with('precinct')
            ->whereIn('status', $status)
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
        
        return response()->json([
            'data' => $this->incidentTransformer->transformCollection($incidents->all()),
            'paginator' => $this->getPaginator($incidents)
        ], 200);
    }

    /**
     * @SWG\Get(
     *     path="/api/incidents/{incidentId}",
     *     summary="Fetch incident by id",
     *     tags={"Incidents"},
     *     description="Fetch incident by id.",
     *     operationId="findIncidentById",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="incidentID",
     *         in="path",
     *         description="Incident ID",
     *         required=true,
     *         type="number",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Incident")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid tag value",
     *     ),
     *     security={
     *         {
     *             "monitorizare_auth": {"read:incidents"}
     *         }
     *     }
     * )
     */
    public function show($incidentId)
    {
        $incident = Incident::with('type')->find($incidentId);

        if (!$incident)
            return $this->notFoundResponse();

        return response()->json([
            'data' => $this->incidentTransformer->transform($incident)
        ], 200);
    }

    /**
     * @SWG\Post(path="/api/incidents",
     *   tags={"Incidents"},
     *   summary="Create an incident",
     *   description="",
     *   operationId="createIncident",
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="order placed for purchasing the pet",
     *     required=false,
     *     @SWG\Schema(ref="#/definitions/Incident")
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
     *     @SWG\Schema(ref="#/definitions/Incident")
     *   ),
     *   @SWG\Response(response=400,  description="Invalid Incident")
     * )
     */
    public function store(Request $request)
    {
        $rules = [
            'firstName' => 'required|max:200',
            'lastName' => 'required|max:200',
            'incidentType' => 'required',
            'description' => 'required',
            'county_id' => 'required',
            'city' => 'required',
            'stationNumber' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Could not create new incident.', $validator->errors());
        }
        
        $incident = new Incident($request->all());
		
        if($incident->save()) {
        	$client = new Client(config('app.wsServerAddr'));
        	$client->send(json_encode(array("data" => Reports::countiesWithIncidents())));
            return $this->response->created();
        }
        else
            return $this->response->error('could_not_create_incident', 500);
    }

    public function approve($incidentId)
    {
        $incident = Incident::find($incidentId);
        if (!$incident)
            return $this->notFoundResponse();

        $incident->status = 'Approved';
        if ($incident->save())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_update_incident', 500);
    }

    public function reject($incidentId)
    {
        $incident = Incident::find($incidentId);
        if (!$incident)
            return $this->notFoundResponse();
        
        $incident->status = 'Rejected';
        if ($incident->save())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_update_incident', 500);
    }

    public function destroy($incidentId)
    {
        $incident = Incident::find($incidentId);

        if (!$incident)
            return $this->notFoundResponse();

        if ($incident->delete())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_delete_incident', 500);
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

    private function notFoundResponse()
    {
        return response()->json([
            'error' => ['message' => 'Record does not exist']
        ], 404);
    }
}
