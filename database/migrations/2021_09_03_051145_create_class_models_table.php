<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_models', function (Blueprint $table) {
            $table->char('Ma_lop',20)->primary();
            $table->string('Ten_lop',20);
            $table->char('Ma_khoa',10);
            $table->foreign('Ma_khoa')->references('Ma_khoa')->on('course_models');
            $table->char('Ma_nganh',20);
            $table->foreign('Ma_nganh')->references('Ma_nganh')->on('majors_models');
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
        Schema::dropIfExists('class_models');
    }
}
