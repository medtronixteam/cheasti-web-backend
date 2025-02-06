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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id('invoice_id');
            $table->string('user_id');
            $table->foreign('user_id')
            ->references('user_id')
            ->on('users')
            ->onDelete('cascade');
            $table->float('amount');
            $table->date('issue_date');
            $table->date('due_date');
            $table->boolean('is_paid');
            $table->string('business_name', 255)->nullable();
            $table->string('service_item', 255);
            $table->float('rate');
            $table->integer('quantity');
            $table->float('tax_percentage');
            $table->float('gst_percentage');
            $table->string('late_fee_type', 255);
            $table->float('late_fee_amount');
            $table->text('billing_address');
            $table->string('currency', 10);
            $table->boolean('is_details_saved');
             $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
