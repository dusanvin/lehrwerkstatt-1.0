<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHasNoAlternativeToLehrStudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lehr_stud', function (Blueprint $table) {
            $table->boolean('has_no_alternative_lehr')->default(false);
            $table->boolean('has_no_alternative_stud')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lehr_stud', function (Blueprint $table) {
            $table->dropColumn('has_no_alternative_lehr');
            $table->dropColumn('has_no_alternative_stud');
        });
    }
}
