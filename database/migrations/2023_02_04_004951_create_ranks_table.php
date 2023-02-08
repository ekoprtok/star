<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('level');
            $table->string('name');
            $table->integer('direct_donator');
            $table->integer('must_have_dwline');
            $table->integer('total_team_donator');
            $table->float('rrank_donation_total', 14, 2);
            $table->float('rreward', 14, 2);
            $table->float('rsocial_event', 14, 2);
            $table->boolean('is_contributor')->default(false);
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
        Schema::dropIfExists('ranks');
    }
}
