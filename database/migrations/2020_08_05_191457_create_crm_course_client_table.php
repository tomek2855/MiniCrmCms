<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmCourseClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_course_client', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('crm_client_id');
            $table->unsignedBigInteger('crm_course_id');
            $table->foreign('crm_client_id')->references('id')->on('crm_clients')->onDelete('cascade');
            $table->foreign('crm_course_id')->references('id')->on('crm_courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_course_client');
    }
}
