<?php

use Illuminate\Database\Seeder;
use App\County;
use App\Helpers\CvsHandler;

class CountiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = $this->getCounties();

        if ($rows) {
            foreach ($rows as $key => $row) {
                County::create(['name' => $row[0], 'code' =>  $row[1]]);
            }
        }       
    }

    private function getCounties()
    {
        $data = CvsHandler::convertToArray('resources/files/county/county.csv');
        return $data;
    }
}

