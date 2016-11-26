<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *   @SWG\Xml(name="County")
 * )
 */
class County extends Model
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
	public $name;

	/**
     * @SWG\Property(format="int64")
     * @var string
     */
	public $code;


	protected $fillable = ['name'];
	
	public $timestamps = false;
	
	public function incidents()
	{
		return $this->hasMany('App\Incident');
	}
}
