<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLstProficiencySublevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lst_proficiency_sublevels', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('value', 30)->unique();
            $table->boolean('active')->default(TRUE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lst_proficiency_sublevels');
    }
}
