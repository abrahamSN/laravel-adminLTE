<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbKeluhan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_keluhan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice');
            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->longText('keterangan');
            $table->enum('status', ['1','2','3'])-> comment('1 = belum di tanggapi, 2 = sedang di proses, 3 = masalah selesai');
            $table->enum('rate', ['1','2','3'])-> comment('1 = belum di rate, 2 = buruk, 3 = baik');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('tb_product')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_keluhan');
    }
}
