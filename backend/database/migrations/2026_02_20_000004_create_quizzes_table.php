<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('series_id')->nullable(); // Link to specific series
            $table->unsignedBigInteger('created_by')->nullable();
            $table->integer('time_limit')->nullable(); // in minutes
            $table->integer('passing_score')->default(70); // percentage
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->foreign('series_id')->references('id')->on('series')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}