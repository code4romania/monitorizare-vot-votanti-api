<?php

namespace App\Api\V1\Controllers;


use App\Precinct;
use App\Api\V1\Transformers\PrecinctTransformer;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;

class PrecinctController extends Controller
{
    use Helpers;

    public function list()
    {
        $precincts = Precinct::get();
        $precinctTransformer = new PrecinctTransformer();
        
        return response()->json(['data' => $precinctTransformer->transformCollection($precincts->all())]);
    }
    
    public function listPerCity($cityId)
    {
        $precincts = Precinct::where('city_id', intval($cityId))->get();
        $precinctTransformer = new PrecinctTransformer();
    
        return response()->json(['data' => $precinctTransformer->transformCollection($precincts->all())]);
    }

}