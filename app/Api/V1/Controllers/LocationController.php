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

    /**
     * @SWG\Get(
     *     path="/api/counties",
     *     summary="Fetch counties",
     *     tags={"Location"},
     *     description="Fetch counties.",
     *     operationId="findCounties",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/County")
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
    public function counties()
    {
        $counties = County::get();
        
        return response()->json([
            'data' => $this->countyTransformer->transformCollection($counties->all())
        ], 200);
    }

    /**
     * @SWG\Get(
     *     path="/api/counties/{countyId}/cities",
     *     summary="Fetch cities by county id",
     *     tags={"Location"},
     *     description="Fetch cities by county id.",
     *     operationId="findCitiesByCountyId",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="countyId",
     *         in="path",
     *         description="County Id",
     *         required=true,
     *         type="number",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/City")
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
    public function cities($countyId)
    {
        $cities = City::where('county_id', $countyId)->get();
        
        return response()->json([
            'data' => $this->cityTransformer->transformCollection($cities->all())
        ], 200);
    }
}
