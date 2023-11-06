<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_models', function (Blueprint $table) {
            $table->char('Ma_SV',15)->primary();
            $table->string('Ho_va_ten',30);
            $table->tinyInteger('Gioi_tinh');
            $table->date('Ngay_sinh');
            $table->string('Email',255)->unique();
            $table->char('Ma_lop',20);
            $table->foreign('Ma_lop')->references('Ma_lop')->on('class_models');
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
        Schema::dropIfExists('student_models');
    }
}
