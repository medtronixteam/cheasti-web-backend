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
        Schema::create('todo_lists', function (Blueprint $table) {
            $table->id('todo_id');
            $table->string('user_id');
            $table->string('categories', 15);
            $table->text('task');
            $table->date('due_date')->nullable();
            $table->time('due_time')->nullable();
            $table->enum('reminder', ['1h', '2h', '3h'])->nullable();
            $table->boolean('repeat_daily')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todo_lists');
    }
};
