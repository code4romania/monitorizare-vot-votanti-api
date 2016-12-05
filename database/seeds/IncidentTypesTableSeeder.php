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
		IncidentType::create([
				'id' => 1,
				'label' => 'IT_OTHER',
				'code' => 'OTH',
				'name' => 'Altul'
		]);
		IncidentType::create([
				'id' => 2,
				'label' => 'IT_ELECTION_DAY',
				'code' => 'ELE',
				'name' => 'Campanie electorală în ziua votului'
		]);
		IncidentType::create([
				'id' => 3,
				'label' => 'IT_MEDIA',
				'code' => 'MED',
				'name' => 'Media & internet'
		]);
		IncidentType::create([
				'id' => 4,
				'label' => 'IT_BRIBE',
				'code' => 'MIT',
				'name' => 'Mită electorală'
		]);
		IncidentType::create([
				'id' => 5,
				'label' => 'IT_OFFICES',
				'code' => 'NBE',
				'name' => 'Nereguli în funcționarea birourilor electorale'
		]);
		IncidentType::create([
				'id' => 6,
				'label' => 'IT_OBSERVERS',
				'code' => 'ACC',
				'name' => 'Observatori acreditați'
		]);
		IncidentType::create([
				'id' => 7,
				'label' => 'IT_OBSERVERS',
				'code' => 'OBP',
				'name' => 'Probleme legate de observatorii acreditați'
		]);
		IncidentType::create([
				'id' => 8,
				'label' => 'IT_ELEC_TURISM',
				'code' => 'TEL',
				'name' => 'Turism electoral'
		]);
		IncidentType::create([
				'id' => 9,
				'label' => 'IT_PUBLIC_FOUNDS',
				'code' => 'FEL',
				'name' => 'Utilizarea fondurilor publice în scopuri electorale'
		]);
		IncidentType::create([
				'id' => 10,
				'label' => 'IT_MULTIPLE',
				'code' => 'VML',
				'name' => 'Vot multiplu'
		]);
		IncidentType::create([
				'id' => 11,
				'label' => 'IT_OPENING',
				'code' => 'OPN',
				'name' => 'Deschidere sectie'
		]);
		IncidentType::create([
				'id' => 12,
				'label' => 'IT_COUNTING',
				'code' => 'NUM',
				'name' => 'Numarare'
		]);
	}
}
