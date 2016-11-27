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
        IncidentType::create(['id' => 1, 'code' => 'OTH', 'name' => 'Altul' ]);
        IncidentType::create(['id' => 2, 'code' => '', 'name' => 'Campanie electorală în ziua votului' ]);
        IncidentType::create(['id' => 3, 'code' => '', 'name' => 'Media & internet' ]);
        IncidentType::create(['id' => 4, 'code' => '', 'name' => 'Mită electorală' ]);
        IncidentType::create(['id' => 5, 'code' => '', 'name' => 'Nereguli în funcționarea birourilor electorale' ]);
        IncidentType::create(['id' => 6, 'code' => '', 'name' => 'Observatori acreditați' ]);
        IncidentType::create(['id' => 7, 'code' => '', 'name' => 'Probleme legate de observatorii acreditați' ]);
        IncidentType::create(['id' => 8, 'code' => '', 'name' => 'Turism electoral' ]);
        IncidentType::create(['id' => 9, 'code' => '', 'name' => 'Utilizarea fondurilor publice în scopuri electorale' ]);
        IncidentType::create(['id' => 10, 'code' => '', 'name' => 'Vot multiplu' ]);
        IncidentType::create(['id' => 10, 'code' => 'OPN', 'name' => 'Deschidere sectie' ]);
        IncidentType::create(['id' => 10, 'code' => 'NUM', 'name' => 'Numarare' ]);
    }
}
