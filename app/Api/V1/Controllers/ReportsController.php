<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReportsController extends Controller
{
    
    use Helpers;

    public function index()
    {   
        return response()->json([
            'totalIncidents' => Reports::totalIncidents(),
            'incidentsByType' => Reports::totalIncidentsByType(),
            'incidentsByCounty' => Reports::countiesWithIncidents()
        ], 200);
    }
}
