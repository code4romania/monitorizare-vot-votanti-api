<?php

namespace App\Api\V1\Transformers;

class CityTransformerAddress extends Transformer
{
    public function transform($precinct)
    {
    	return [
            'id' => $precinct->county_id,
            'county' => $precinct->county,
            'name' => $precinct->address,
            'sirutaCode' => $precinct->siruta_code,
            'electoralCircleCode' => $precinct->circ_no
        ];
    }
}
