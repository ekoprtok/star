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
     * 1 Deposit Wallet
     * 2 Withdrawal Wallet
     * 3 Transfer Internal Wallet
     * 4 Donation Packages
     * 5 Daily Blessing
     * 6 Reward (naik Rank)
     * 7 Social Event (naik Rank)
     * 8 Different Rate
     * 9 Package Redeem
     * 10 Kindness Meter 100%
     */
    public function up()
    {
        Schema::create('user_wallet_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('trx_at');
            $table->string('trx_id');
            $table->integer('type');
            $table->string('user_id');
            $table->string('user_wallet_id');
            $table->float('amount', 14, 3);
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
