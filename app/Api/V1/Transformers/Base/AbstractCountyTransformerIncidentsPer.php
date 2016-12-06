<?php
namespace App\Api\V1\Transformers\Base;

use App\Api\V1\Transformers\Transformer;

abstract class AbstractCountyTransformerIncidentsPer extends Transformer
{
    public function transform($county)
    {
    	return [
    	    'id' => $county['id'],
            'countyName' => $county['name'],
    		'incidentsCount' => $county->incidents()->where('incident_type_id', $this->getIncidentTypeId())->count()
        ];
    }
    
    abstract protected function getIncidentTypeId();
}
