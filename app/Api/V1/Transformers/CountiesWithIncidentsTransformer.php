<?php

namespace App\Api\V1\Transformers;

class CountiesWithIncidentsTransformer extends Transformer
{
    public function transform($county)
    {
    	return [
            'id' => $county['id'],
            'countyName' => $county['name'],
    		'incidentsCount' => $county->incidents()->count()
        ];
    }
}
