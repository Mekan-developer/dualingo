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
        Schema::table('pronunciations', function (Blueprint $table) {
            // Dropping an old column
            $table->dropColumn('audio');

            
            // Adding a new column
            $table->json('audio')->after('id');

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pronunciations', function (Blueprint $table) {
            // Rolling back by removing the new column
            $table->dropColumn('audio');

            // Re-adding the old column (optional, based on your rollback requirements)
            $table->string('audio')->nullable();
        });
    }
};
