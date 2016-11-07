<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use App\Incident;
use App\User;

class IncidentController extends Controller
{
    use Helpers;

    public function index()
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $incidents = Incident::with('type')->get();
        
        return response()->json([
            'data' => $this->transformCollection($incidents)
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
            'data' => $this->transform($incident->toArray())
        ], 200);
    }

    private function transformCollection($incidents)
    {
        return array_map([$this, 'transform'], $incidents->toArray());
    }

    private function transform($incident)
    {
        return [
            'name' => $incident['name'],
            'description' => $incident['description'],
            'start_date' => $incident['start_date'],
            'end_date' => $incident['end_date']
        ];
    }
}
