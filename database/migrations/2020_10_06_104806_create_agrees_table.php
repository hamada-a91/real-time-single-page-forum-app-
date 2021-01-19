<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('suggestment_id')->unsigned();
            $table->foreign('suggestment_id')->references('id')->on('suggestments')->onDelete('cascade');
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
        Schema::dropIfExists('agrees');
    }
}
