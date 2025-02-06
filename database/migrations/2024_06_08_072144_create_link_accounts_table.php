<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    { 
        Schema::create('link_accounts', function (Blueprint $table) {
            $table->id('link_account_id');
            $table->string('user_id');
            $table->string('account_name', 100);
            $table->string('account_oauth2_token', 522);
            $table->string('refresh_oauth2_token', 255)->nullable();
            $table->dateTime('token_expiration');
            $table->string('link_email', 255);
            $table->string('account_id', 255)->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'account_name'], 'user_account_index');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_accounts');
    }
};
