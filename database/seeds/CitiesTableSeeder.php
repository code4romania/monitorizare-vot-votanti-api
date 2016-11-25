<?php

use Illuminate\Database\Seeder;
use App\City;
use App\Helpers\CvsHandler;
use App\Helpers\CitiesXMLParser;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = $this->getCities();

        if ($rows) {
            foreach ($rows as $key => $row) {
                City::create([
                    'id' => $key,
                    'county_id' => $this->getCountyId($row[1]),
                    'name' => $row[2],
                    'siruta_code' => $row[3],
                    'el_circle_code' => $row[4]
                ]);
            }
        }       
    }

    private function getCities()
    {
        
        $cities = CitiesXMLParser::convertToArray('resources/files/cities/cities.xml');
        var_dump($cities);
    }

    private function getCountyId($countyCode)
    {
        $counties = CvsHandler::convertToArray('resources/files/county/county.csv');
        foreach ($counties as $key => $county) {
            if ($county[1] == $countyCode) {
                return $county[0];
            }
        }
        return 43;
    }
}

