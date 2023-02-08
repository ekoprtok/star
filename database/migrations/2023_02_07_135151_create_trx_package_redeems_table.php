<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxPackageRedeemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_package_redeems', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('submitted_at');
            $table->string('user_id');
            $table->string('package_id');
            $table->enum('package_type', ['0', '1'])->default('1');
            $table->float('kindeness_percen');
            $table->float('rdonation');
            $table->float('redeem_rate');
            $table->float('ramount');
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
        Schema::dropIfExists('trx_package_redeems');
    }
}
