<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_models', function (Blueprint $table) {
           $table->id();
            $table->char('Ma_monhoc',20);
            $table->foreign('Ma_monhoc')->references('Ma_monhoc')->on('subject_models');
            $table->char('Ma_SV',15);
            $table->foreign('Ma_SV')->references('Ma_SV')->on('student_models');
            $table->tinyInteger('Hoc_ky');
            $table->tinyInteger('Lan_thi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score_models');
    }
}
