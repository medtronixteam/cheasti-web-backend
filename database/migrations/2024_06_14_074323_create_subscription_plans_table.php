<?php
// database/migrations/2024_06_14_000000_create_subscription_plans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSubscriptionPlansTable extends Migration
{
    public function up()
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('name');
            $table->decimal('price', 8, 2);
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

        // Insert the three plans
        DB::table('subscription_plans')->insert([
            [
                'id' => 1,
                'name' => 'Basic',
                'price' => 30.00,
                'description' => 'Basic plan description',
            ],
            [
                'id' => 2,
                'name' => 'Pro',
                'price' => 40.00,
                'description' => 'Pro plan description',
            ],
            [
                'id' => 3,
                'name' => 'Enterprise',
                'price' => 50.00,
                'description' => 'Enterprise plan description',
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('subscription_plans');
    }
}
