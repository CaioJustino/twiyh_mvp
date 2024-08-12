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
        Schema::create('lodges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->references('id')->on('companies');
            $table->string('name', 80);
            $table->string('desc', 150);
            $table->integer('clients_amount');
            $table->boolean('kids');
            $table->boolean('pets');
            $table->boolean('breakfast');
            $table->boolean('gym');
            $table->boolean('pool');
            $table->integer('rooms_amount');
            $table->float('price');
            $table->boolean('status');
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
        Schema::dropIfExists('lodges');
    }
};
