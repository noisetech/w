<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dpa', function (Blueprint $table) {
            $table->id();
            $table->string('no_dpa')->nullable();
            $table->foreignId('urusan_id')->nullable();
            $table->foreignId('bidang_id')->nullable();
            $table->foreignId('program_id')->nullable();
            $table->foreignId('kegiatan_id')->nullable();
            $table->foreignId('organisasi_id')->nullable();
            $table->foreignId('unit_id')->nullable();
            $table->text('sasaran_program')->nullable();
            $table->longText('capaian_program')->nullable();
            $table->longText('alokasi_tahun')->nullable();
            $table->longText('indikator_kinerja')->nullable();
            $table->longText('kelompok_sasaran_kegiatan')->nullable();
            $table->longText('rencana_penarikan')->nullable();
            $table->longText('tim_anggaran')->nullable();
            $table->longText('ttd_dpa')->nullable();
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
        Schema::dropIfExists('dpa');
    }
}
