<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReleasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('releases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->integer('year')->unsigned();
            $table->string('catalog_no', 32);
            $table->string('isbn', 32);
            $table->text('notes');
            $table->text('tracklist')->nullable();
            $table->boolean('use_recording_photo')->default(true);
            $table->integer('recording_id')->unsigned();
            $table->integer('label_id')->unsigned();
            $table->integer('format_id')->unsigned();
            $table->integer('country_id')->unsigned();
            $table->index('recording_id');
            $table->index('label_id');
            $table->index('format_id');
            $table->index('country_id');
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
        Schema::drop('releases');
    }
}
