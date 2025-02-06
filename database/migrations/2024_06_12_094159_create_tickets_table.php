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
        Schema::create('ticket', function (Blueprint $table) {
            $table->increments('ticket_id');
            $table->string('user_id');
            $table->string('question', 255);
            $table->string('reply', 255)->nullable();
            $table->enum('status', ['Open', 'Closed'])->default('Open');
            $table->timestamps(0); // Disables fractional seconds.
            $table->foreign('user_id')
            ->references('user_id')
            ->on('users')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
