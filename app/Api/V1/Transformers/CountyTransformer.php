<?php

namespace App\Api\V1\Transformers;

class CountyTransformer extends Transformer
{
    public function transform($county)
    {
    	$countyArr = $county->toArray();
    	return [
            'id' => $countyArr['id'],
            'name' => $countyArr['name'],
            'code' => $countyArr['code'],
    		'incidents' => $county->incidents()->count()
        ];
    }
}
