<?php

use Illuminate\Database\Seeder;
use App\County;
use App\Helpers\CvsHandler;
use App\Precinct;
use App\City;

use Akeneo\Component\SpreadsheetParser\SpreadsheetParser;

class PrecinctsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::disableQueryLog(); //logs slow down inserts
		$counties = CvsHandler::convertToArray('resources/files/county/county.csv');

    	$inputFileName = 'resources/files/precincts/Precincts.xlsx';

		try {
    		$workbook = SpreadsheetParser::open($inputFileName);
		}
		
		catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
		}

		$cityId = null;

    	foreach ($workbook->createRowIterator(0) as $rowIndex => $rowData) {
			if ($rowIndex > 2 && $rowData[0] != '') {

				if (trim($rowData[1]) != '') {
					$cityId = $this->getCityId($rowData[1]);
				}
				
				$precinct = new Precinct([
					'county_id' => $this->getCountyId($rowData[0], $counties),
					'city_id' =>  $cityId,
					'siruta_code' =>  $rowData[2],
					'circ_no' =>  $rowData[3],
					'precinct_no' =>  $rowData[4],
					'headquarter' =>  $rowData[5],
					'address' =>  $rowData[6]
				]);

        		$precinct->save();
			}
   		}
    }

	private function getCountyId($countyCode, $counties) 
	{
		foreach ($counties as $key => $county) {
            if ($county[2] == $countyCode) {
                return $county[0];
            }
        }

        echo "County not found: " . $countyCode . "\r\n";
		return 0;
	}

	private function getCityId($cityName)
	{
		$city = City::where('name', $cityName)->first();
		if ($city) {
			return $city->id;
		} 

		echo "City not found:" . $cityName . "\r\n";
		return 0;
	}
}

