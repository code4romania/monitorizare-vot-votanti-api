<?php

namespace App\Api\V1\Transformers;

class PrecinctTransformerIncidentsTypePerPrecinct extends Transformer
{
    public function transform($precinct)
    {
    	return [
            'county' => $precinct->county->code,
    		'city' => $precinct->city->name,
    		'precinctNo' => $precinct->precinct_no,
    		'value' => $precinct->aggregate
        ];
    }
}
