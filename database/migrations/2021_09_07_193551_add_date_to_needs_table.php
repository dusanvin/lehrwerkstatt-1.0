<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateToNeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('needs', function (Blueprint $table) {
            $table->date('datum_start');
            $table->date('datum_end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('needs', function (Blueprint $table) {
            $table->dropColumn('datum_start');
            $table->dropColumn('datum_end');
        });
    }
}
