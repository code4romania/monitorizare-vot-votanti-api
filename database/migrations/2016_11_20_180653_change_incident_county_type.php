<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIncidentCountyType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	//Created like this because of bug with Doctrine enum when using change()
    	Schema::table('incidents', function($table)
    	{
    		DB::statement('ALTER TABLE incidents MODIFY county INT');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('incidents', function($table)
    	{
    		DB::statement('ALTER TABLE incidents MODIFY county VARCHAR(255)');
    	});
    }
}
