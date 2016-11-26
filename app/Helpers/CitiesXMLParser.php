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
		$cities = [];

		foreach ($xml->cities as $item) {
			array_push($cities, [
				'countyCode' => (string)$item->JUD,
				'name' => (string)$item->DENUMIRE_x0020_UAT,
				'siruta_code' => (string)$item->COD_x0020_SIRUTA,
				'el_circle_code' => (string)$item->NR__x0020_CIRC_x0020__ELECT
			]);
		}

		return $cities;
	}
}
