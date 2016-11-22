<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
	protected $fillable = ['name'];
	
	public $timestamps = false;
	
	public function incident()
	{
		return $this->hasMany('App\Incident');
	}
}
