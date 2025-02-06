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
        Schema::create('contents', function (Blueprint $table) {
            $table->id('video_id');
            $table->string('title', 250);
            $table->string('description', 500);
            $table->unsignedBigInteger('category');
            $table->string('tags', 250)->nullable();
            $table->string('caption', 500)->nullable();
            $table->string('file_path', 500)->nullable();
            $table->string('thumbnail_path', 500)->nullable();
            $table->json('platforms');
            $table->enum('status', ['pending', 'in_progress', 'uploaded'])->default('pending');
            $table->dateTime('scheduled_at')->nullable();
            $table->string('user_id');
            $table->timestamps();
            $table->softDeletes(); // Adds the deleted_at column for soft deletes

            // additional for futute use
            // $table->string('location')->nullable();
            // $table->enum('privacy', ['public', 'private'])->nullable();
            // $table->string('language')->nullable();
            // $table->string('audience')->nullable();
            // $table->json('additional_files')->nullable();

            $table->index('category');

            // Foreign key constraint for user_id
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
