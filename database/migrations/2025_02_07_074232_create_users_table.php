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
        Schema::create('users', function (Blueprint $table) {
            $table->string('user_id')->primary();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->text('photo')->nullable();
            $table->enum('role', ['user', 'admin', 'owner'])->default('user');
            $table->enum('login_type', ['Normal', 'Google', 'Apple'])->default('Normal');
            $table->boolean('is_plan_active')->default(false);
            $table->string('current_plan')->nullable();
            $table->string('stripe_id')->nullable()->index();
            $table->string('pm_type')->nullable();
            $table->string('pm_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
            $table->longText('jwt_key')->nullable();
            $table->string('plan_active_date')->nullable();
            $table->string('plan_expire_date')->nullable();
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
};
