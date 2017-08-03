<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrasis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_reg');
            $table->integer('pembayaran_id')->unsigned();
            $table->integer('siswa_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('kelas_id')->unsigned();
            $table->integer('jenis_pembayaran_id')->unsigned();
            $table->integer('semester');
            $table->integer('bayar');
            $table->integer('tunggakan');
            $table->string('keterangan');
            $table->foreign('jenis_pembayaran_id')->references('id')->on('jenis_pembayarans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pembayaran_id')->references('id')->on('pembayarans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('registrasis');
    }
}
