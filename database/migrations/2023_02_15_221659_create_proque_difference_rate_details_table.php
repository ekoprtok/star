<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProqueDifferenceRateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proque_difference_rate_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('proque_id');
            $table->string('user_id');
            $table->string('rank_id');
            $table->float('rate', 14, 3);
            $table->float('rdonation', 14, 3);
            $table->float('ramount', 14, 3);
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
        Schema::dropIfExists('proque_difference_rate_details');
    }
}
