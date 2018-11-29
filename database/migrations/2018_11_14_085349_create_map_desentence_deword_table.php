<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapDesentenceDewordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_desentence_deword', function (Blueprint $table) {
            $table->unsignedInteger('de_sentence_id');  // [PK] FK
            $table->unsignedInteger('de_word_id');      // [PK] FK
        });

        Schema::table('map_desentence_deword', function (Blueprint $table) {
            $table->primary([ 'de_sentence_id', 'de_word_id'  ]);
            
            $table->foreign('de_sentence_id')->references('id')->on('de_sentences');
            $table->foreign('de_word_id')->references('id')->on('de_words');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('map_desentence_deword');
    }
}
