<?php

namespace App\Helpers;

class CitiesXMLParser
{
	protected $path = '';
	protected $delimiter = ',';

	public static function convertToArray($path)
	{
		if(!file_exists($path) || !is_readable($path)) {
			return FALSE;
		}

		$xml = simplexml_load_file($path);
		foreach ($xml->cities as $item) {
			$city = [
				'countyCode' => (string)$item->JUD,
				'name' => (string)$item->DENUMIRE_X0020_UAT,
				'sirutaCode' => (string)$item->COD_X0020_SIRUTA[0],
				'elCircleCode' => (string)$item->NR__x0020_CIRC_X0020_ELECT[0]
			];

			var_dump($city);
			dd();
		  	foreach($element as $key => $val) {
		   		echo "{$key}: {$val}";
		  	}
		}
	}
}
