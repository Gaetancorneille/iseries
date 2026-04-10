<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('series_id');
            $table->integer('episode_number');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('video_url')->nullable();
            $table->integer('duration')->nullable(); // in minutes
            $table->date('release_date')->nullable();
            $table->string('photo_url')->nullable();
            $table->timestamps();
            
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
            $table->unique(['season_id', 'episode_number']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}