<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id(); // autoincrement_primary_key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 
            $table->text('body'); // 
            $table->int('rahmen'); // 
            $table->text('sprachkenntnisse'); // 
            $table->text('studiengang'); // 
            $table->int('fachsemester'); // 
            $table->date('datum_start'); //
            $table->date('datum_end'); //
            $table->timestamps(); //created_at && updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
