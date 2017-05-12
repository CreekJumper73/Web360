<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodetypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CodeTypes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Categories_Id')->unsigned();
            $table->foreign('Categories_Id')->references('id')->on('categories');
            $table->string('CodeType_Description');
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
        Schema::dropIfExists('CodeType');
    }
}
