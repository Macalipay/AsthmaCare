<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('city')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('company_id')->nullable();;
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        
        DB::table('users')->insert([
            [
                'firstname' => 'Admin', 
                'middlename' => '', 
                'lastname' => '', 
                'lastname' => 'Account', 
                'gender' => 'Male', 
                'age' => '0', 
                'contact_no' => '',
                'city' => '',
                'username' => 'admin', 
                'email' => 'admin@gmail.com', 
                'password' => Hash::make('admin123')
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
