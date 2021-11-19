<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('start_date');
            $table->string('end_date');
            $table->unsignedBigInteger('doctor_id');
            $table->longText('patient_remarks')->nullable();
            $table->longText('doctor_remarks')->nullable();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('user_id');
            $table->string('link');
            $table->string('status');
            $table->timestamps();
            
            $table->foreign('doctor_id')
                ->references('id')
                ->on('users');

            $table->foreign('patient_id')
                ->references('id')
                ->on('patients');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment');
    }
}
