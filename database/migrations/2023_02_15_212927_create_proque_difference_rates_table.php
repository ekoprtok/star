<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProqueDifferenceRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proque_difference_rates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('queue_id');
            $table->string('trx_packages_id');
            $table->float('diff_rate_max', 14, 3);
            $table->enum('is_process', ['0', '1'])->default('0');
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
        Schema::dropIfExists('proque_difference_rates');
    }
}
