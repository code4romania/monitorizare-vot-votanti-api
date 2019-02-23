<?php

namespace App\Api\V1\Transformers;

use App\IncidentType;
use App\Api\V1\Transformers\Base\AbstractCountyTransformerIncidentsPer;

class CountyTransformerIncidentsPerCountyCounting extends AbstractCountyTransformerIncidentsPer
{
    protected function getIncidentTypeId() {
    	$type = IncidentType::where('code', 'NUM')->first();
    	return $type->id;
    }
}
