<?php

namespace App\Api\V1\Transformers;

use App\Incident;

class IncidentTransformer extends Transformer
{

    public function transform(Incident $incident)
    {
    	return [
            'id' => $incident['id'],
            'name' => $incident['first_name'] . ' ' . $incident['last_name'],
            'incidentType' => $incident['type'],
            'description' => $incident['description'],
            'county' => $incident->county->name,
            'city' => $incident['city'],
            'station_number' => $incident['station_number'],
            'image_url' => $incident['image_url'],
            'status' => $incident['status'],
            'createdAt' => $incident['created_at']->toDateTimeString()
        ];
    }
}
