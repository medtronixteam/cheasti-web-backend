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
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('invoice_id');
            $table->string('user_id')->index('invoices_user_id_foreign');
            $table->double('amount', 8, 2);
            $table->date('issue_date');
            $table->date('due_date');
            $table->boolean('is_paid');
            $table->string('business_name')->nullable();
            $table->string('service_item');
            $table->double('rate', 8, 2);
            $table->integer('quantity');
            $table->double('tax_percentage', 8, 2);
            $table->double('gst_percentage', 8, 2);
            $table->string('late_fee_type');
            $table->double('late_fee_amount', 8, 2);
            $table->text('billing_address');
            $table->string('currency', 10);
            $table->boolean('is_details_saved');
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
        Schema::dropIfExists('invoices');
    }
};
