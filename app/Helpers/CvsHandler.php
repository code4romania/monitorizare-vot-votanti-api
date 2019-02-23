<?php

namespace App\Helpers;

class CvsHandler
{
	protected $path = '';
	protected $delimiter = ',';

	public static function convertToArray($path)
	{
		if(!file_exists($path) || !is_readable($path)) {
			return FALSE;
		}

		$data = array();

		if (($handle = fopen($path, 'r')) !== FALSE)
		{
			while (($row = fgetcsv($handle, 1000, ',')) !== FALSE)
			{
				$data[] = $row;
			}
			fclose($handle);
		}

		return $data;
	}
}
