<?php

namespace App\Api\V1\Transformers;

class IncidentTransformer extends Transformer
{

    public function transform($incident)
    {
    	return [
            'name' => $incident['first_name'] . ' ' . $incident['last_name'],
            'type' => $incident['type'] ? $incident['type']['name'] : '',
            'description' => $incident['description'],
            'start_date' => $incident['start_date'],
            'end_date' => $incident['end_date']
        ];
    }
}
