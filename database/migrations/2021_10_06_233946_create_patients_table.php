<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->unsignedBigInteger('asthma_id');
            $table->string('asthma_level');
            $table->string('gender');
            $table->string('age');
            $table->string('contact');
            $table->string('email');
            $table->timestamps();

            $table->foreign('asthma_id')
            ->references('id')
            ->on('asthmas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
