<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeWordPrepositionInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('de_word_preposition_infos', function (Blueprint $table) {
            $table->unsignedInteger('de_word_id');                      // PK + FK
            
            $table->unsignedSmallInteger('prepo_case');                 // FK
            $table->unsignedSmallInteger('wo_wann_case')->nullable();   // FK
            $table->unsignedSmallInteger('wohin_case')->nullable();     // FK
            $table->unsignedSmallInteger('wie_case')->nullable();       // FK
        });

        Schema::table('de_word_preposition_infos', function (Blueprint $table) {
            $table->primary('de_word_id');
            $table->foreign('de_word_id')->references('id')->on('de_words');

            $table->foreign('prepo_case')->references('id')->on('lst_word_cases');
            $table->foreign('wo_wann_case')->references('id')->on('lst_word_cases');
            $table->foreign('wohin_case')->references('id')->on('lst_word_cases');
            $table->foreign('wie_case')->references('id')->on('lst_word_cases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('de_word_preposition_infos');
    }
}
