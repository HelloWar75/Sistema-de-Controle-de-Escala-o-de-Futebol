<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAthletesPartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('athletes_parties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('party_id');
            $table->unsignedBigInteger('athlete_id');
            $table->timestamps();

            $table->foreign('party_id')->references('id')->on('parties');
            $table->foreign('athlete_id')->references('id')->on('athletes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('athletes_parties');
    }
}
