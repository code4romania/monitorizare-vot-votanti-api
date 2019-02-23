<?php

namespace App\Api\V1\Transformers;

use App\IncidentType;
use App\Api\V1\Transformers\Base\AbstractCountyTransformerIncidentsPer;

class CountyTransformerIncidentsPerCountyOpening extends AbstractCountyTransformerIncidentsPer
{
    protected function getIncidentTypeId() {
    	$type = IncidentType::where('code', 'OPN')->first();
    	return $type->id;
    }
}
