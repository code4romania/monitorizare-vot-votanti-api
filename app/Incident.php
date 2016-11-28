<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *   @SWG\Xml(name="Incident")
 * )
 */
class Incident extends Model
{

    /**
     * @SWG\Property(format="int64")
     * @var int
     */
    public $id;

    /**
     * @SWG\Property()
     * @var string
     */
    public $firstName;

    /**
     * @SWG\Property()
     * @var string
     */
    public $lastName;

    /**
     * @SWG\Property()
     * @var int
     */
    public $countyId;

    /**
     * @SWG\Property()
     * @var int
     */
    public $cityId;

    /**
     * @SWG\Property()
     * @var int
     */
    public $incidentTypeId;

    /**
     * @SWG\Property()
     * @var string
     */
    //public $stationNumber;

    /**
     * @SWG\Property()
     * @var string
     */
    //public $description;

    protected $fillable = [
    	'first_name', 'last_name', 'county_id', 'city_id', 'incident_type_id', 'station_number', 'description', 'image_url'
    ];

    // One to many inverse relation to IncidentType model
    public function type()
    {
    	return $this->belongsTo('App\IncidentType', 'incident_type_id', 'id');
    }
    
    // One to many inverse relation to County model
    public function county()
    {
    	return $this->belongsTo('App\County');
    }

    // One to many inverse relation to City model
    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
