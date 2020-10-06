<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_courses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('email', 255);
            $table->string('number', 255);
            $table->string('pesel', 11);
            $table->string('address_number', 255);
            $table->string('address_street', 255);
            $table->string('address_city', 255);
            $table->string('address_zipcode', 255);
            $table->unsignedBigInteger('course_id');

            $table->string('ip');

            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_courses');
    }
}
