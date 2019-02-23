<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PublicController extends Controller
{
    
    use Helpers;

    public function check()
    {
        return response()->json([
            'project_name' => 'Monitorizare Vot',
            'version' => '1.0'
        ], 200);
    }
}
