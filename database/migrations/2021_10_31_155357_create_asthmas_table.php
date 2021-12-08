<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsthmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asthmas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('asthma');
            $table->string('level');
            $table->longText('description');
            $table->unsignedBigInteger('symptoms_id');
            $table->timestamps();
            
            $table->foreign('symptoms_id')
                ->references('id')
                ->on('symptoms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asthmas');
    }
}
