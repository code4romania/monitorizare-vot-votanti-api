<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Api\V1\Transformers\IncidentTransformer;

use App\Incident;
use App\User;

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
        $currentUser = JWTAuth::parseToken()->authenticate();
        $limit = Input::get('limit') ?: 20;
        $limit = min($limit, 200);
        $status = Input::get('status')  ?: ['Approved'];

        $incidents = Incident::with('type')
            ->whereIn('status', $status)
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
        
        return response()->json([
            'data' => $this->incidentTransformer->transformCollection($incidents->all()),
            'paginator' => $this->getPaginator($incidents)
        ], 200);
    }

    public function show($incidentId)
    {
        $incident = Incident::with('type')->find($incidentId);

        if (!$incident)
            return $this->notFoundResponse();

        return response()->json([
            'data' => $this->incidentTransformer->transform($incident)
        ], 200);
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
