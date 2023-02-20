<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnerWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owner_wallets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id');
            $table->float('rbalance_amount', 14, 3);
            $table->float('rbalance_amount_real', 14, 3);
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
        Schema::dropIfExists('owner_wallets');
    }
}
