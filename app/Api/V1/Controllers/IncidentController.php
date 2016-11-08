<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
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
        $incidents = Incident::with('type')->get();
        
        return response()->json([
            'data' => $this->incidentTransformer->transformCollection($incidents->all())
        ], 200);
    }

    public function show($incidentId)
    {
        $incident = Incident::with('type')->find($incidentId);

        if (!$incident)
        {
            return response()->json([
                'error' => ['message' => 'Record does not exist']
            ], 404);
        }

        return response()->json([
            'data' => $this->incidentTransformer->transform($incident->toArray())
        ], 200);
    }
}
