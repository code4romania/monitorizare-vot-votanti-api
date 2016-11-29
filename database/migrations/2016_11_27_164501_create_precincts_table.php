<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrecinctsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('precincts', function (Blueprint $table) {
    		$table->increments('id');
    		$table->integer('county_id');
    		$table->integer('city_id');
    		$table->integer('siruta_code');
    		$table->integer('circ_no');
    		$table->integer('precinct_no');
    		$table->string('headquarter');
    		$table->string('address');
    		$table->timestamps();
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('precincts');
    }
}
