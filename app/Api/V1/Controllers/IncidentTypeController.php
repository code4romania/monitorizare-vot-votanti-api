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

    public function index()
    {
    	return response()->json([
            'data' => IncidentType::get()
        ], 200);
    }
}
