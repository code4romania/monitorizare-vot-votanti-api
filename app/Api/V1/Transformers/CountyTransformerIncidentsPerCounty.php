<?php

namespace App\Api\V1\Transformers;

class CountyTransformerIncidentsPerCounty extends Transformer
{
    public function transform($county)
    {
    	return [
            'label' => $county['name'],
    		'value' => $county->incidents()->count()
        ];
    }
}
