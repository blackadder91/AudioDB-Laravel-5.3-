<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title')->nullable();
            $table->string('filename');
            $table->integer('image_type_id');
            $table->integer('imageable_id');
            $table->string('imageable_type');
            $table->index(['image_type_id', 'imageable_id']);
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
        Schema::drop('images');
    }
}
