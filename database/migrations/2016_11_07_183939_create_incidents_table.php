<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('county_id');
            $table->integer('city_id');
            $table->string('incident_type_id');
            $table->string('precinct_id');
            $table->string('description');
            $table->string('image_url');
            $table->enum('status', ['Approved', 'Pending', 'Rejected'])->default('Approved');
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
        Schema::drop('incidents');
    }
}
