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

    	$this->parseRomaniaPrecincts('resources/files/precincts/Precincts.xlsx', $counties);
   		$this->parseDiasporaPrecincts('resources/files/precincts/Diaspora.json');
    }
    
    private function parseRomaniaPrecincts($file, $counties) {
    	$inputFileName = $file;
    	
    	try {
    		$workbook = SpreadsheetParser::open($inputFileName);
    	}
    	
    	catch(Exception $e) {
    		die('Error loading file "'.pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    	}
    	
    	$cityId = null;
    	
    	$precinctId = -1;
    	foreach ($workbook->createRowIterator(0) as $rowIndex => $rowData) {
    		if ($rowIndex > 2 && $rowData[0] != '') {
    	
    			if (trim($rowData[1]) != '') {
    				$cityId = $this->getCityId($rowData[1]);
    			}
    	
    			if($rowData[4] != $precinctId) {
    				$precinctId = $rowData[4];
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
    }
    
    /**
     * Get the Diaspora Precincts.
     * @param unknown $file
     */
    private function parseDiasporaPrecincts($file) {
    	//get Diaspora county ID
    	$county = County::where('code', 'DI')->first();
    	//get Diaspora city ID
    	$city = City::where('name', 'Disapora city')->first();
    	//Put the precincts in the table
    	$f = fopen($file, "r");
    	$str = "";
    	while($line = fgets($f)) {
    		$str .= $line;
    	}
    	$obj = json_decode($str);
    	foreach ($obj->markers as $marker) {
    		$precinct = new Precinct([
    				'county_id' => $county->id,
    				'city_id' =>  $city->id,
    				'siruta_code' =>  0,
    				'circ_no' =>  $marker->country_id,
    				'precinct_no' =>  $marker->n,
    				'headquarter' =>  $marker->m,
    				'address' =>  $marker->a
    		]);
    		$precinct->save();
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

