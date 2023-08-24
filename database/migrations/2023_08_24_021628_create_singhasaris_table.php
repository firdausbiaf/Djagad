<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinghasarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('singhasaris', function (Blueprint $table) {
            $table->id();
            $table->enum('kluster', ['1'])->default('1');
            $table->string('kavling');
            $table->integer('sold')->default(0);
            $table->integer('open')->default(0);
            $table->string('keterangan');
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
        Schema::dropIfExists('singhasaris');
    }
}
