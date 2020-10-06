<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_clients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('pesel')->nullable();
            $table->char('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->string('birth_city')->nullable();

            $table->string('address_city')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_postal_code')->nullable();
            $table->string('address_house_number')->nullable();
            $table->string('address_apartment_number')->nullable();

            $table->text('info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_clients');
    }
}
