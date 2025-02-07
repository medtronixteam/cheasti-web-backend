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
        Schema::create('plan_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id')->nullable();
            $table->string('prod_name')->nullable();
            $table->double('amount')->default(0);
            $table->string('currency', 10)->nullable();
            $table->string('bill_interval')->nullable();
            $table->unsignedBigInteger('processed')->default(0);
            $table->string('email', 40)->nullable();
            $table->string('user_id')->index('plan_requests_user_id_foreign');
            $table->string('first_name', 40)->nullable();
            $table->string('last_name', 40)->nullable();
            $table->string('city', 40)->nullable();
            $table->string('postal_code', 20)->nullable();
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
        Schema::dropIfExists('plan_requests');
    }
};
