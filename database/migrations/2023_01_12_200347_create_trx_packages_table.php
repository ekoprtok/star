<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_packages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('submitted_at');
            $table->string('user_id');
            $table->string('package_id');
            $table->text('file_path')->nullable();;
            $table->string('responsed_by')->nullable();
            $table->string('responsed_at')->nullable();
            $table->enum('package_type', ['0', '1'])->default('1');
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
        Schema::dropIfExists('trx_packages');
    }
}
