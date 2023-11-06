<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_models', function (Blueprint $table) {
            $table->char('Ma_monhoc',20)->primary();
            $table->string('Ten_mon',30);
            $table->integer('So_tin_chi');
            $table->string('Hinh_thuc_thi');
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
        Schema::dropIfExists('subject_models');
    }
}
