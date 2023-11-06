<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreDetailModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_detail_models', function (Blueprint $table) {
            $table->id();
            $table->foreign('id')->references('id')->on('score_models');
            $table->float('Diem_ly_thuyet');
            $table->float('Diem_thuc_hanh');
            $table->char('Ma_SV',15);
            $table->foreign('Ma_SV')->references('Ma_Sv')->on('student_models');
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
        Schema::dropIfExists('score_detail_models');
    }
}
