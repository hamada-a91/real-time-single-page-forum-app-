<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisagreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disagrees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('suggestment_id')->unsigned();
            $table->integer('user_id');
            $table->timestamps();
            $table->foreign('suggestment_id')->references('id')->on('suggestments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disagrees');
    }
}
