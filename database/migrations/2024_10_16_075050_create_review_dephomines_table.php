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
        Schema::create('review_dephomines', function (Blueprint $table) {
            $table->id();
            $table->string('dopamine1');
            $table->string('dopamine2');
            $table->string('dopamine3');
            $table->string('audio');
            $table->timestamps();
        });

        Artisan::call('db:seed', ['--class' => 'ReviewSeeder']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_dephomines');
    }
};
