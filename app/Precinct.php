<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Precinct extends Model
{
	public function incidents()
	{
		return $this->hasMany('App\Incident');
	}
	
	public function county()
	{
		return $this->belongsTo('App\County');
	}
	
	public function city()
	{
		return $this->belongsTo('App\City');
	}
}
