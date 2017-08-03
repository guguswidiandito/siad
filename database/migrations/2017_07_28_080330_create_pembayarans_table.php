<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_pembayaran');
            $table->string('operator');
            $table->integer('user_id')->unsigned();
            $table->integer('siswa_id')->unsigned();
            $table->integer('jenis_pembayaran_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jenis_pembayaran_id')->references('id')->on('jenis_pembayarans')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('pembayarans');
    }
}
