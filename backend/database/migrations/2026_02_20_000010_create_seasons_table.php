<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('series_id');
            $table->integer('season_number');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->date('release_date')->nullable();
            $table->integer('episode_count')->default(0);
            $table->timestamps();
            
            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
            $table->unique(['series_id', 'season_number']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('seasons');
    }
}