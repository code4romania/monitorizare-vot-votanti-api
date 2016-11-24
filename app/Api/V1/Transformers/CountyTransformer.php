<?php

namespace App\Api\V1\Transformers;

class CountyTransformer extends Transformer
{
    public function transform($county)
    {
    	return [
            'id' => $county['id'],
            'name' => $county['name'],
            'code' => $county['code'],
    		'incidents' => $county->incidents()->count()
        ];
    }
}
