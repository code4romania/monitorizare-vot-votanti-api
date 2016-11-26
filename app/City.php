<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *   @SWG\Xml(name="City")
 * )
 */
class City extends Model
{
	/**
     * @SWG\Property(format="int64")
     * @var int
     */
	public $id;

	/**
     * @SWG\Property(format="int64")
     * @var int
     */
	public $countyId;

	/**
     * @SWG\Property()
     * @var string
     */
	public $name;

	/**
     * @SWG\Property()
     * @var string
     */
	public $sirutaCode;

	/**
     * @SWG\Property()
     * @var string
     */
	public $electoralCircleCode;

	protected $fillable = [
		'county_id', 'name', 'siruta_code', 'el_circle_code'
	];
	
	public $timestamps = false;
	
	public function county()
	{
		return $this->belongsTo('App\County');
	}
}
