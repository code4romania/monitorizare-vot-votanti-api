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
		return $this->hasOne('App\County');
	}
	
	public function city()
	{
		return $this->hasOne('App\City');
	}
}
