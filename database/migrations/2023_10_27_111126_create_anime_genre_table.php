<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimeGenreTable extends Migration
{
    public function up()
    {
        Schema::create('anime_genre', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anime_id');
            $table->unsignedBigInteger('genre_id');
            $table->foreign('anime_id')->references('id')->on('animes');
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anime_genre');
    }
}




