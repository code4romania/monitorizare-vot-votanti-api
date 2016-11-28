<?php
namespace App\Api\V1\Transformers\Base;

use App\Api\V1\Transformers\Transformer;

abstract class AbstractCountyTransformerIncidentsPer extends Transformer
{
    public function transform($county)
    {
    	return [
            'label' => $county['name'],
    		'value' => $county->incidents()->count()
        ];
    }
    
    abstract protected function getIncidentTypeId();
}
