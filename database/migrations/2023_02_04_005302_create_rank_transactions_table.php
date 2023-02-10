<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rank_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id');
            $table->string('parent_id')->nullable();
            $table->string('rank_id');
            $table->integer('direct_donator');
            $table->integer('must_have_dwline');
            $table->integer('total_team_donator');
            $table->float('rrank_donation_total', 14, 3);
            $table->float('rreward', 14, 3);
            $table->float('rsocial_event', 14, 3);
            $table->integer('res_direct_donator');
            $table->integer('res_must_have_dwline');
            $table->integer('res_total_team_donator');
            $table->float('res_rrank_donation_total', 14, 3);
            $table->float('res_rreward', 14, 3);
            $table->float('res_rsocial_event', 14, 3);
            $table->enum('status', ['0', '1'])->default('0');
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
        Schema::dropIfExists('rank_transactions');
    }
}
