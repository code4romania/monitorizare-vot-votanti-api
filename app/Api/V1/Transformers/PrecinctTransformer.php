<?php

namespace App\Api\V1\Transformers;

class PrecinctTransformer extends Transformer
{
    public function transform($precinct)
    {
        return [
                 
                'id' => $precinct['id'],
                'county' => $precinct['county_id'],
                'city' => $precinct['city_id'],
                'precinctNo' => $precinct['precinct_no']
        ];
    }
}
