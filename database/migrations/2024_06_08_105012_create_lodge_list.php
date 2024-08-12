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
        Schema::create('lodge_list', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lodge_id')->references('id')->on('lodges');
            $table->foreignId('package_id')->references('id')->on('packages');
            $table->date('start_date');
            $table->date('final_date');
            $table->float('price');
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
        Schema::dropIfExists('lodge_list');
    }
};
