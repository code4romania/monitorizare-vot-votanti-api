<?php

namespace App\Api\V1\Transformers;

class IncidentTransformer extends Transformer
{

    public function transform($incident)
    {
    	return [
            'id' => $incident['id'],
            'name' => $incident['first_name'] . ' ' . $incident['last_name'],
            'incidentType' => $incident['type'],
            'description' => $incident['description'],
            'startDate' => $incident['start_date'],
            'endDate' => $incident['end_date'],
            'status' => $incident['status'],
            'createdAt' => $incident['created_at']->toDateTimeString()
        ];
    }
}
