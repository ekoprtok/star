<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxSocialEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_social_events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('submitted_at');
            $table->string('event_at');
            $table->string('user_id');
            $table->string('rank_id');
            $table->text('description');
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
        Schema::dropIfExists('trx_social_events');
    }
}
