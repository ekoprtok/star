<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnerWalletHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owner_wallet_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('trx_at');
            $table->string('trx_id');
            $table->string('trx_user_id');
            $table->string('type');
            $table->string('owner_wallet_id');
            $table->string('amount');
            $table->enum('status', ['in', 'out'])->default('in');
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
        Schema::dropIfExists('owner_wallet_histories');
    }
}
