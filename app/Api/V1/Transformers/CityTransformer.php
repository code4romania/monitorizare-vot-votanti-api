<?php

namespace App\Api\V1\Transformers;

class CityTransformer extends Transformer
{
    public function transform($county)
    {
    	return [
            'id' => $county['id'],
            'county' => $county['county'],
            'name' => $county['name'],
            'sirutaCode' => $county['siruta_code'],
            'electoralCircleCode' => $county['el_circle_code']
        ];
    }
}
