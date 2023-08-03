<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegalitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legalitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_id');
            $table->string('nomor');
            $table->integer('uang_masuk')->default(0);
            $table->date('tgl_masuk');
            $table->integer('uang_keluar')->default(0);
            $table->date('tgl_keluar');
            $table->timestamps();

            $table->foreign('data_id')->references('id')->on('data')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legalitas');
    }
}
