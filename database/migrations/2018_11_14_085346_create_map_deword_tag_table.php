<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapDewordTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_deword_tag', function (Blueprint $table) {
            $table->unsignedInteger('de_word_id');  // [PK] FK
            $table->unsignedSmallInteger('tag_id'); // [PK] FK
        });

        Schema::table('map_deword_tag', function (Blueprint $table) {
            $table->primary([ 'de_word_id', 'tag_id'  ]);
            
            $table->foreign('de_word_id')->references('id')->on('de_words');
            $table->foreign('tag_id')->references('id')->on('lst_tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('map_deword_tag');
    }
}
