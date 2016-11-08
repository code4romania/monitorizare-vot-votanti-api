<?php

use Illuminate\Database\Seeder;
use App\IncidentType;

class IncidentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IncidentType::create([ 'name' => 'Nerespectare regulament' ]);
        IncidentType::create([ 'name' => 'Frauda vot' ]);
        IncidentType::create([ 'name' => 'Altul' ]);
    }
}
