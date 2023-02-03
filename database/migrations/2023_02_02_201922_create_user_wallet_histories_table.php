<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWalletHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_wallet_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('trx_at');
            $table->string('trx_id');
            $table->integer('type'); // 1 deposit, 2 wd, 3 trf, 4 donation, 5 dialy
            $table->string('user_id');
            $table->string('user_wallet_id');
            $table->float('amount');
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
        Schema::dropIfExists('user_wallet_histories');
    }
}
