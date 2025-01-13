<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('pdf_name');
            $table->string('exam_title');
            $table->string('director')->nullable();
            $table->integer('marks')->nullable();
            $table->string('time')->nullable();
            $table->timestamps();
        });
    }
    
 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
