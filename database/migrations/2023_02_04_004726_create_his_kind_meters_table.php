<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHisKindMetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('his_kind_meters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id');
            $table->string('package_id');
            $table->float('percentage', 14, 2);
            $table->enum('type', ['1', '2'])->default('1'); // 1 beli paket, 2 daily challenge
            $table->enum('status', ['0', '1'])->default('0'); // 1 claimed, 0 open
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
        Schema::dropIfExists('his_kind_meters');
    }
}
