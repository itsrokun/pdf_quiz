<?php

// database/migrations/2025_01_01_000001_create_questions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
            $table->text('question_text');
            $table->string('option_a')->nullable();
            $table->string('option_b')->nullable();
            $table->string('option_c')->nullable();
            $table->string('option_d')->nullable();
            $table->string('correct_option')->nullable();
            $table->text('solution')->nullable();
            $table->text('explanation')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
}