<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('alamat');
            $table->string('kavling');
            $table->enum('lokasi',['DJAGAD LAND BATU','DJAGAD LAND SINGHASARI','DPARK CITY'])->default('DJAGAD LAND BATU');
            $table->unsignedBigInteger('tipe');
            $table->string('spk');
            $table->unsignedBigInteger('harga_deal');
            $table->unsignedBigInteger('cicilan');
            $table->unsignedBigInteger('uang_masuk');
            $table->unsignedBigInteger('progres');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
}
