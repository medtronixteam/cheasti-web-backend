<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_accounts', function (Blueprint $table) {
            $table->bigIncrements('link_account_id');
            $table->string('user_id');
            $table->string('account_name', 100);
            $table->string('account_oauth2_token', 522);
            $table->string('refresh_oauth2_token')->nullable();
            $table->dateTime('token_expiration');
            $table->string('link_email');
            $table->string('account_id')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'account_name'], 'user_account_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_accounts');
    }
};
