<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_withdrawals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('submitted_at');
            $table->string('user_wallet_id');
            $table->float('amount', 14, 2);
            $table->float('withdrawal_fee', 14, 2);
            $table->float('net_amount', 14, 2);
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
        Schema::dropIfExists('trx_withdrawals');
    }
}
