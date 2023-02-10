<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('level');
            $table->float('rvalue', 14, 3);
            $table->float('rdonation', 14, 3);
            $table->float('rjoin_fee', 14, 3);
            $table->float('rdaily_blessing', 14, 3);
            $table->text('img_url')->nullable();
            $table->integer('gen_deep');
            $table->string('created_by');
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
        Schema::dropIfExists('packages');
    }
}
