<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $fillable = [
    	'first_name', 'last_name', 'county', 'city', 'incident_type_id', 'station_number', 'description', 'image_url'
    ];

    // One to many inverse relation to IncidentType model
    public function type()
    {
    	return $this->belongsTo('App\IncidentType', 'incident_type_id', 'id');
    }
    
    // One to many inverse relation to County model
    public function county()
    {
    	return $this->belongsTo('App\County', 'county_id', 'id');
    }
}
