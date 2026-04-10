<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesActorsTable extends Migration
{
    public function up()
    {
        Schema::create('series_actors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('series_id');
            $table->unsignedBigInteger('actor_id');
            $table->string('character_name')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
            $table->foreign('actor_id')->references('id')->on('actors')->onDelete('cascade');
            $table->unique(['series_id', 'actor_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('series_actors');
    }
}