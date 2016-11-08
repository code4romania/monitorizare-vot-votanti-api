<?php

use Illuminate\Database\Seeder;

use App\IncidentType;
use App\Incident;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        IncidentType::truncate();
        Incident::truncate();
        User::truncate();
        Eloquent::unguard();

        $this->call(IncidentTypesTableSeeder::class);
        $this->call(IncidentsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
