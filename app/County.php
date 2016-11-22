<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
	protected $fillable = ['name'];
	
	public $timestamps = false;
	
	public function incidents()
	{
		return $this->hasMany('App\Incident');
	}
}
