<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLehrStudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lehr_stud', function (Blueprint $table) {
            $table->id();
            $table->integer('lehr_id');
            $table->integer('stud_id');
            $table->boolean('is_accepted_lehr')->default(false);
            $table->boolean('is_accepted_stud')->default(false); 
            $table->float('mse');
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
        Schema::dropIfExists('lehr_stud');
    }
}