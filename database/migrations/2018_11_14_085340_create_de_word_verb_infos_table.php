<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeWordVerbInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('de_word_verb_infos', function (Blueprint $table) {
            $table->unsignedInteger('de_word_id');          // PK + FK
            
            $table->unsignedSmallInteger('verb_case');      // FK

            $table->string('infinitive', 80)->nullable();  
            $table->string('perfekt', 80)->nullable(); 
            $table->string('praeteritum', 80)->nullable(); 
            $table->text('conjugation_dump')->nullable();
        });

        Schema::table('de_word_verb_infos', function (Blueprint $table) {
            $table->primary('de_word_id');
            $table->foreign('de_word_id')->references('id')->on('de_words');

            $table->foreign('verb_case')->references('id')->on('lst_word_cases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('de_word_verb_infos');
    }
}
