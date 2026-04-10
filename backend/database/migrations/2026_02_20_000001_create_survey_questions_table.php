<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('survey_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('survey_id');
            $table->text('question');
            $table->string('type')->default('multiple_choice'); // multiple_choice, text, rating
            $table->json('options')->nullable(); // For multiple choice options
            $table->boolean('is_required')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('survey_questions');
    }
}