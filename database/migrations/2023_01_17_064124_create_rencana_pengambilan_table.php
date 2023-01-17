<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaPengambilanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_pengambilan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_dpa_id');
            $table->string('bulan');
            $table->integer('pengambilan');
            $table->string('jenis_belanja');
            $table->integer('total_anggaran_jenis_belanja');
            $table->longText('status_pelaksana')->nullable();
            $table->longText('keterangan_pelaksanaan')->nullable();
            $table->string('persentase')->nullable();
            $table->string('status_kemanfaatan')->nullable();
            $table->longText('keterangan_permsalahan')->nullable();
            $table->longText('dokumen_bukti_pendukung')->nullable();
            $table->longText('foto_bukti_pendukung')->nullable();
            $table->longText('video_bukti_pendukung')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('rencana_pengambilan');
    }
}
