<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeSentenceInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('de_sentence_infos', function (Blueprint $table) {
            $table->unsignedInteger('de_sentence_id'); // PK + FK

            $table->unsignedSmallInteger('proficiency_level');              // FK
            $table->unsignedSmallInteger('proficiency_sublevel');           // FK
            $table->unsignedSmallInteger('source')->nullable();             // FK
            $table->unsignedSmallInteger('priority_level')->nullable();     // FK
            $table->unsignedSmallInteger('revision_set')->nullable();       // FK

            $table->unsignedMediumInteger('no_visited')->default(0);
            $table->unsignedMediumInteger('no_wrong')->default(0);
            $table->unsignedMediumInteger('no_correct')->default(0);
            $table->text('comment')->nullable();
            $table->timestamp('last_visited_on')->useCurrent();
        });

        Schema::table('de_sentence_infos', function (Blueprint $table) {
            $table->primary('de_sentence_id'); // PK
            $table->foreign('de_sentence_id')->references('id')->on('de_words'); // FK

            $table->foreign('proficiency_level')->references('id')->on('lst_proficiency_levels'); // FK
            $table->foreign('proficiency_sublevel')->references('id')->on('lst_proficiency_sublevels'); // FK
            $table->foreign('source')->references('id')->on('lst_sources'); // FK
            $table->foreign('priority_level')->references('id')->on('lst_priority_levels'); // FK
            $table->foreign('revision_set')->references('id')->on('lst_revision_sets'); // FK
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('de_sentence_infos');
    }
}
