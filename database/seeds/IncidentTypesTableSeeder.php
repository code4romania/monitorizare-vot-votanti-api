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
        IncidentType::create(['id' => 1, 'name' => 'Altul' ]);
        IncidentType::create(['id' => 2, 'name' => 'Campanie electorală în ziua votului' ]);
        IncidentType::create(['id' => 3, 'name' => 'Media & internet' ]);
        IncidentType::create(['id' => 4, 'name' => 'Mită electorală' ]);
        IncidentType::create(['id' => 5, 'name' => 'Nereguli în funcționarea birourilor electorale' ]);
        IncidentType::create(['id' => 6, 'name' => 'Observatori acreditați' ]);
        IncidentType::create(['id' => 7, 'name' => 'Probleme legate de observatorii acreditați' ]);
        IncidentType::create(['id' => 8, 'name' => 'Turism electoral' ]);
        IncidentType::create(['id' => 9, 'name' => 'Utilizarea fondurilor publice în scopuri electorale' ]);
        IncidentType::create(['id' => 10, 'name' => 'Vot multiplu' ]);
    }
}
