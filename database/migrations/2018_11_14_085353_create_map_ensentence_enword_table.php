<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapEnsentenceEnwordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_ensentence_enword', function (Blueprint $table) {
            $table->unsignedInteger('en_sentence_id');  // [PK] FK
            $table->unsignedInteger('en_word_id');      // [PK] FK
        });

        Schema::table('map_ensentence_enword', function (Blueprint $table) {
            $table->primary([ 'en_sentence_id', 'en_word_id'  ]);
            
            $table->foreign('en_sentence_id')->references('id')->on('en_sentences');
            $table->foreign('en_word_id')->references('id')->on('en_words');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('map_ensentence_enword');
    }
}
