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
        Schema::table('contents', function (Blueprint $table) {
            // Make sure the category column exists and is of the right type
            $table->unsignedBigInteger('category')->change();
            
            // Add foreign key constraint
            $table->foreign('category')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade'); // Adjust as needed (cascade, restrict, etc.)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contents', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['category']);
        });
    }
};
