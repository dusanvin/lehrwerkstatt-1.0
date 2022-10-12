<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLehrStudMatchableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lehr_stud_matchable', function (Blueprint $table) {
            $table->unsignedBigInteger('lehr_id');
            $table->unsignedBigInteger('stud_id');
            $table->foreign('lehr_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('stud_id')->references('id')->on('users')->onDelete('cascade');
            $table->float('mse');
            $table->boolean('recommended')->default(false);
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
        Schema::dropIfExists('lehr_stud_matchable');
    }
}
