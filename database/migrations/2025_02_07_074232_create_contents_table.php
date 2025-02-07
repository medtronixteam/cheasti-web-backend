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
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('video_id');
            $table->string('title', 250);
            $table->string('description', 500);
            $table->unsignedBigInteger('category')->index();
            $table->string('tags', 250)->nullable();
            $table->string('caption', 500)->nullable();
            $table->string('file_path', 500)->nullable();
            $table->string('thumbnail_path', 500)->nullable();
            $table->json('platforms');
            $table->enum('status', ['pending', 'in_progress', 'uploaded'])->default('pending');
            $table->dateTime('scheduled_at')->nullable();
            $table->string('user_id')->index('contents_user_id_foreign');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
};
