<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Notes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Categories_Id')->unsigned();
            $table->foreign('Categories_Id')->references('id')->on('categories');
            $table->integer('CodeTypes_Id')->unsigned();
            $table->foreign('CodeTypes_Id')->references('id')->on('codetypes');
            $table->longtext('Body');
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
        Schema::dropIfExists('Notes');
    }
}
