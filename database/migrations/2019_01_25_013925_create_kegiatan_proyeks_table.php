<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatanProyeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_proyeks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proyek_id')->unsigned();
            $table->foreign('proyek_id')->references('id')->on('daftar_proyeks')->onDelete('cascade');
            $table->string('kegiatan');
            $table->integer('unit');
            $table->string('satuan');
            $table->integer('harga');
            $table->integer('anggaran');
            $table->string('gambar');
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
        Schema::dropIfExists('kegiatan_proyeks');
    }
}
