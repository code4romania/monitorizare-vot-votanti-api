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
        IncidentType::create(['id' => 2, 'code' => 'ELE', 'name' => 'Campanie electorală în ziua votului' ]);
        IncidentType::create(['id' => 3, 'code' => 'MED', 'name' => 'Media & internet' ]);
        IncidentType::create(['id' => 4, 'code' => 'MIT', 'name' => 'Mită electorală' ]);
        IncidentType::create(['id' => 5, 'code' => 'NBE', 'name' => 'Nereguli în funcționarea birourilor electorale' ]);
        IncidentType::create(['id' => 6, 'code' => 'ACC', 'name' => 'Observatori acreditați' ]);
        IncidentType::create(['id' => 7, 'code' => 'OBP', 'name' => 'Probleme legate de observatorii acreditați' ]);
        IncidentType::create(['id' => 8, 'code' => 'TEL', 'name' => 'Turism electoral' ]);
        IncidentType::create(['id' => 9, 'code' => 'FEL', 'name' => 'Utilizarea fondurilor publice în scopuri electorale' ]);
        IncidentType::create(['id' => 10, 'code' => 'VML', 'name' => 'Vot multiplu' ]);
        IncidentType::create(['id' => 11, 'code' => 'OPN', 'name' => 'Deschidere sectie' ]);
        IncidentType::create(['id' => 12, 'code' => 'NUM', 'name' => 'Numarare' ]);
    }
}
