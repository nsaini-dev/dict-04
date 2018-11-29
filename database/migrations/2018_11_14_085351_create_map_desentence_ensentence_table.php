<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapDesentenceEnsentenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_desentence_ensentence', function (Blueprint $table) {
            $table->unsignedInteger('de_sentence_id'); // [PK] FK
            $table->unsignedInteger('en_sentence_id'); // [PK] FK
        });

        Schema::table('map_desentence_ensentence', function (Blueprint $table) {
            $table->primary([ 'de_sentence_id', 'en_sentence_id'  ]);
            
            $table->foreign('de_sentence_id')->references('id')->on('de_sentences');
            $table->foreign('en_sentence_id')->references('id')->on('en_sentences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('map_desentence_ensentence');
    }
}
