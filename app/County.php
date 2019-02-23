<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *   @SWG\Xml(name="County")
 * )
 * 
 * @property integer $id
 * @property string $name
 * @property string $code
 */
class County extends Model
{
	protected $fillable = ['name', 'code'];
	
	public $timestamps = false;
	
	public function incidents()
	{
		return $this->hasMany('App\Incident');
	}
	
	public function precincts()
	{
		return $this->hasMany('App\Precinct');
	}
}
