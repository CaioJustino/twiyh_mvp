<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->foreignId('id')->references('id')->on('users')->unique();
            $table->string('cnpj');
            $table->boolean('inn');
            $table->boolean('attraction');
            $table->boolean('restaurant');
            $table->boolean('guide');
            $table->boolean('car_rental');
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
        Schema::dropIfExists('companies');
    }
};
