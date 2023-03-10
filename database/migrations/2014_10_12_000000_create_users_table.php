<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('rank_id')->default('0');
            $table->string('referral_code')->nullable();
            $table->enum('role', ['0', '8', '9'])->default('0');
            $table->enum('status', ['0', '1'])->default('0');
            $table->string('password');
            $table->string('web_token')->nullable();
            $table->string('ref_temp')->nullable();
            $table->string('deep')->default('0');
            $table->string('google_secret')->nullable();
            $table->enum('is_active_2fa', ['0', '1'])->default('0');
            $table->enum('have_input_2fa', ['0', '1'])->default('0');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
