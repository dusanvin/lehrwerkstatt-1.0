<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('filename');
            //$table->string('type'); // mimes:jpg, jpeg, png, bmp
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
        //DB::statement("ALTER TABLE images ADD data MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefiles');
    }
}
