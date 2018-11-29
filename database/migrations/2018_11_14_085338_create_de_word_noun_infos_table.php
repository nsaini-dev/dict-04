<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeWordNounInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('de_word_noun_infos', function (Blueprint $table) {
            $table->unsignedInteger('de_word_id'); // PK + FK
            
            $table->string('gender', 10);
            $table->string('gender_short', 10);
            $table->string('article', 10);
            $table->string('plural', 60)->nullable();
        });

        Schema::table('de_word_noun_infos', function (Blueprint $table) {
            $table->primary('de_word_id');
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
        Schema::dropIfExists('de_word_noun_infos');
    }
}
