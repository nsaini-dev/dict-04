<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapDewordEnwordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_deword_enword', function (Blueprint $table) {
            $table->unsignedInteger('de_word_id'); // [PK] FK
            $table->unsignedInteger('en_word_id'); // [PK] FK 
        });

        Schema::table('map_deword_enword', function (Blueprint $table) {
            $table->primary([ 'de_word_id', 'en_word_id'  ]);
            
            $table->foreign('de_word_id')->references('id')->on('de_words');
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
        Schema::dropIfExists('map_deword_enword');
    }
}
