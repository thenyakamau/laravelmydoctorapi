<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('doctors', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('hospital_id');
                $table->string('doctor_stamp');
                $table->string('doctor_speciality');
                $table->double('rating');
                $table->string('uploads');
                $table->string('work_phone');
                $table->string('work_time');
                $table->timestamps();
    
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('hospital_id')->references('id')->on('hospital')->onDelete('cascade');
            });
     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
