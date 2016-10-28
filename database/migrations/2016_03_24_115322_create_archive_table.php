<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('arch_disc_id')->unsigned();
            $table->integer('release_id')->unsigned();
            $table->integer('file_format_id')->unsigned();
            $table->tinyInteger('flags')->unsigned()->default(0);
            $table->string('notes')->nullable();
            $table->index('arch_disc_id');
            $table->index('release_id');
            $table->index('file_format_id');
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
        Schema::drop('archive');
    }
}
