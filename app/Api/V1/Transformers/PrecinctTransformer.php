<?php

namespace App\Api\V1\Transformers;

use App\County;

class PrecinctTransformer extends Transformer
{
    public function transform($precinct)
    {
        $countyAbroad = County::where('code', 'DI')->first();
        $countyAbroadId = $countyAbroad->id;
        $additional = '';
        if($countyAbroadId == $precinct['county_id']) {
            $additional = $precinct->address;
        }
        
        return [
                 
                'id' => $precinct['id'],
                'county' => $precinct['county_id'],
                'city' => $precinct['city_id'],
                'precinctNo' => $precinct['precinct_no'],
                'additional' => $additional
        ];
    }
}
