<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use App\IncidentType;

class IncidentTypeController extends Controller
{
    use Helpers;

    /**
	 * @SWG\Get(
	 *     path="/api/incidents/types",
	 *     summary="Fetch incidents types",
	 *     tags={"IncidentTypes"},
	 *     description="Fetch incident types.",
	 *     operationId="findIncidentTypes",
	 *     consumes={"application/json"},
	 *     produces={"application/json"},
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
    public function index()
    {
    	return response()->json([
            'data' => IncidentType::get()
        ], 200);
    }
}
