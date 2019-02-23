<?php

namespace App\Api\V1\Transformers;

class IncidentTypeTransformerReport extends Transformer
{

    public function transform($incidentTypeStructure)
    {
    	return [
            'county_id' => $incidentTypeStructure->county->name,
    		'incidents' => $incidentTypeStructure->incidents_no
            
        ];
    }
}
