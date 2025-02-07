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
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('name');
            $table->string('package_id')->nullable();
            $table->decimal('price');
            $table->text('description');
            $table->boolean('invoices')->default(false);
            $table->boolean('notes')->default(false);
            $table->boolean('planner_scheduler')->default(false);
            $table->boolean('editor_software')->default(false);
            $table->boolean('auto_content')->default(false);
            $table->boolean('multiple_platform_link')->default(false);
            $table->boolean('automation_cloud_data')->default(false);
            $table->boolean('auto_scheduler')->default(false);
            $table->boolean('admin_owner')->default(false);
            $table->boolean('automation')->default(false);
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
        Schema::dropIfExists('subscription_plans');
    }
};
