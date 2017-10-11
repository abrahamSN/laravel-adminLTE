<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePekerjaKeluhan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for associating roles to users (Many-to-Many)
        Schema::create('pekerja_keluhan', function (Blueprint $table) {
            $table->integer('keluhan_id')->unsigned();
            $table->integer('pekerja_id')->unsigned();

            $table->foreign('keluhan_id')->references('id')->on('tb_keluhan')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pekerja_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['keluhan_id', 'pekerja_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pekerja_keluhan');
    }
}
