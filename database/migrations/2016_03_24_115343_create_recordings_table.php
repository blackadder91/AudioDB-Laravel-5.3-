<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recordings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->date('year');
            $table->integer('artist_id')->unsigned();
            $table->integer('label_id')->unsigned();
            $table->integer('album_type_id')->unsigned();
            $table->integer('genre_id')->unsigned();
            $table->text('tracklist')->nullable();
            $table->index('artist_id');
            $table->index('label_id');
            $table->index('album_type_id');
            $table->index('genre_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recordings');
    }
}
