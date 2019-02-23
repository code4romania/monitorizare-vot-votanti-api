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

    /**
    * @SWG\Get(
    *     path="/api/reports",
    *     summary="Fetch report summary",
    *     tags={"Reports"},
    *     description="Fetch rerpots summary.",
    *     operationId="fetchReportsSummary",
    *     consumes={"application/json"},
    *     produces={"application/json"},
    *     @SWG\Response(
    *         response=200,
    *         description="successful operation",
    *         @SWG\Schema(
    *             type="array"
    *         ),
    *     ),
    *     @SWG\Response(
    *         response="400",
    *         description="Invalid tag value",
    *     ),
    *     security={
    *         {
    *             "monitorizare_auth": {"read:reports"}
    *         }
    *     }
    * )
    */
    public function index()
    {   
        return response()->json([
            'totalIncidents' => Reports::totalIncidents(),
            'incidentsByType' => Reports::totalIncidentsByType(),
            'incidentsByCounty' => Reports::countiesWithIncidents()
        ], 200);
    }
}
