<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	protected $fillable = [
		'county_id', 'name', 'siruta_code', 'el_circle_code'
	];
	
	public $timestamps = false;
	
	public function county()
	{
		return $this->belongsTo('App\County');
	}
}
