<?php

namespace App\Api\V1\Controllers;

use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use App\Api\V1\Transformers\CountyTransformer;

use App\County;

class LocationController extends Controller
{
    use Helpers;

    protected $countryTransformer;

    function __construct(CountyTransformer $countyTransformer)
    {
        $this->countyTransformer = $countyTransformer;
    }

     public function counties()
    {
        $counties = County::get();
        
        return response()->json([
            'data' => $this->countyTransformer->transformCollection($counties->all())
        ], 200);
    }
}
