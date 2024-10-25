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
        Schema::table('question_images', function (Blueprint $table) {
             // Добавляем две новые колонки
            $table->json('translation_correct_words')->after('id');
            $table->json('translation_incorrect_words')->after('translation_correct_words');;
 
             // Удаляем две существующие колонки
             $table->dropColumn('correct_text');
             $table->dropColumn('incorrect_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('question_images', function (Blueprint $table) {
            // Удаляем добавленные колонки
            $table->dropColumn('translation_correct_words');
            $table->dropColumn('translation_incorrect_words');

            // Восстанавливаем удаленные колонки
            $table->string('correct_text')->after('id');;
            $table->string('incorrect_text')->after('correct_text');;
        });
    }
};
