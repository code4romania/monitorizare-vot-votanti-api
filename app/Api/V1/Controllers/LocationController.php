<?php

namespace App\Api\V1\Controllers;

use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use App\Api\V1\Transformers\CountyTransformer;
use App\Api\V1\Transformers\CityTransformer;

use App\County;
use App\City;

class LocationController extends Controller
{
    use Helpers;

    protected $countryTransformer;

    function __construct(CountyTransformer $countyTransformer, CityTransformer $cityTransformer)
    {
        $this->countyTransformer = $countyTransformer;
        $this->cityTransformer = $cityTransformer;
    }

    public function counties()
    {
        $counties = County::get();
        
        return response()->json([
            'data' => $this->countyTransformer->transformCollection($counties->all())
        ], 200);
    }

    public function cities($countyId)
    {
        $cities = City::where('county_id', $countyId)->get();
        
        return response()->json([
            'data' => $this->cityTransformer->transformCollection($cities->all())
        ], 200);
    }
}
