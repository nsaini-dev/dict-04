<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapDewordWordtypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_deword_wordtype', function (Blueprint $table) {
            $table->unsignedInteger('de_word_id');              // [PK] FK
            $table->unsignedSmallInteger('word_type_id');   // [PK] FK
        });


        Schema::table('map_deword_wordtype', function (Blueprint $table) {
            $table->primary([ 'de_word_id', 'word_type_id'  ]);

            $table->foreign('de_word_id')->references('id')->on('de_words');
            $table->foreign('word_type_id')->references('id')->on('lst_word_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('map_deword_wordtype');
    }
}
