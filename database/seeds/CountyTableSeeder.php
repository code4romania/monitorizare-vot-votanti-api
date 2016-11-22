<?php

use Illuminate\Database\Seeder;
use App\County;

class CountyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$f = fopen("resources/files/county/county.txt", "r");
    	
    	while ($str = fgets($f))
    	{
    		County::create([
    				'name' => str_replace("\n", "", $str)
    		]);
    	}
    }
}
