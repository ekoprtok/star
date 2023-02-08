<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxDailyChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_daily_challenges', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('submitted_at');
            $table->string('user_id');
            $table->string('package_id');
            $table->string('dialy_challenge_id');
            $table->string('file_path')->nullable();
            $table->enum('status', ['0', '1', '2'])->default('0');
            $table->string('responsed_by')->nullable();
            $table->string('responsed_at')->nullable();
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
        Schema::dropIfExists('trx_dialy_challenges');
    }
}
