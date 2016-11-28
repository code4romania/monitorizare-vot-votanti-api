<?php

use Illuminate\Database\Seeder;
use App\County;
use App\Helpers\CvsHandler;
use App\Precinct;
use App\City;

class PrecinctsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$inputFileName = 'resources/files/precincts/Precincts.xlsx';
    	
    	//  Read your Excel workbook
    	try {
    		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
    		$objPHPExcel = $objReader->load($inputFileName);
    	} catch(Exception $e) {
    		die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    	}
    	
    	$sheet = $objPHPExcel->getSheet(0);
    	
    	$precinct = null;
    	$precinctNo = null;
    	//65536
    	$row=3;
    	$rowData[0] = "start";
    	while ($rowData[0] != ""){
    		$rowData = $sheet->rangeToArray('A' . $row . ':' . 'L' . $row, NULL, FALSE, FALSE);
    		$rowData = $rowData[0];
    		
    		//Save precinct when there's a new precinct number
    		if($rowData[4] != $precinctNo) {
    			if($precinct != null) {
    				$precinct->settlements = json_encode($settlements);
    				$precinct->save();
    			}
    		}
    		
    		//Initialize precinct data when there's a new section number different from the last one
    		if($rowData[6] != NULL) {
    			$countyCode = trim($rowData[0]);
    			$county = County::where('code', $countyCode)->first();
    			$cityName = trim($rowData[1]);
    			$city = City::where('name', $cityName)->first();
    			$precinctNo = $rowData[4];
    			$precinct = new Precinct();
    			$precinct->county_id = $county->id;
    			$precinct->city_id = $city->id;
    			$precinct->siruta_code = $rowData[2];
    			$precinct->circ_no = $rowData[3];
    			$precinct->precinct_no = $rowData[4];
    			$precinct->headquarter = $rowData[5];
    			$precinct->address = $rowData[6];
    			$settlements = array(array($rowData[8], $rowData[9], $rowData[10], $rowData[11]));
    		}
    		else {
    			array_push($settlements, array($rowData[8], $rowData[9], $rowData[10], $rowData[11]));
    		}
    		$row++;
    	}
    	$precinct->settlements = json_encode($settlements);
    	$precinct->save();
    }
}

