<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMotivationStudiengangFachsemesterInteressenErfahrungenTreffenGruesse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('motivation');
            $table->string('studiengang');
            $table->integer('fachsemester');
            $table->text('interessen');
            $table->text('erfahrungen');
            $table->text('treffen');
            $table->text('gruesse');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('motivation');
            $table->dropColumn('studiengang');
            $table->dropColumn('fachsemester');
            $table->dropColumn('interessen');
            $table->dropColumn('erfahrungen');
            $table->dropColumn('treffen');
            $table->dropColumn('gruesse');
        });
    }
}
