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
        Schema::create('plan_requests', function (Blueprint $table) {
            $table->id();
            $table->string("product_id")->nullable();
            $table->string("prod_name")->nullable();
            $table->double("amount")->default(0);
            $table->string("currency",10)->nullable();
            $table->string("bill_interval")->nullable();
            $table->unsignedBigInteger("processed")->default(0);
            $table->string("email",40)->nullable();

            $table->string('user_id');
            $table->string("first_name",40)->nullable();
            $table->string("last_name",40)->nullable();
            $table->string("city",40)->nullable();
            $table->string("postal_code",20)->nullable();
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_requests');
    }
};
