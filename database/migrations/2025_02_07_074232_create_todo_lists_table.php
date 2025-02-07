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
        Schema::create('todo_lists', function (Blueprint $table) {
            $table->bigIncrements('todo_id');
            $table->string('user_id')->index('todo_lists_user_id_foreign');
            $table->string('categories', 15);
            $table->text('task');
            $table->date('due_date')->nullable();
            $table->time('due_time')->nullable();
            $table->enum('reminder', ['1h', '2h', '3h'])->nullable();
            $table->boolean('repeat_daily')->nullable();
            $table->boolean('is_completed')->default(false);
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
        Schema::dropIfExists('todo_lists');
    }
};
