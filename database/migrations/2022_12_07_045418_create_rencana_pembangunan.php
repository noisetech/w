<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaPembangunan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_pembangunan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('detail_ket_sub_dpa_id')->nullable();
            $table->integer('nilai_kontrak')->nullable();
            $table->text('nomor_kontrak')->nullable();
            $table->date('tanggal_kontrak')->nullable();
            $table->text('pejabat_ppk')->nullable();
            $table->text('pelaksana')->nullable();
            $table->text('lokasi_realisasi_anggaran')->nullable();
            $table->integer('jangka_waktu')->nullable();
            $table->date('mulai_kerja')->nullable();
            $table->longText('kendala_hambatan')->nullable();
            $table->integer('tenaga_kerja')->nullable();
            $table->enum('penerapan_k3', ['ya', 'tidak'])->nullable();
            $table->longText('keterangan')->nullable();
            $table->integer('progress_pelaksanaan')->nullable();
            $table->integer('rencana_pelaksanaan')->nullable();
            $table->integer('realisasi_pelaksanaan')->nullable();
            $table->integer('deviasi_pelaksanaan')->nullable();
            $table->longText('keselamatan_kontruksi')->nullable();
            $table->longText('catatan')->nullable();
            $table->longText('tim_monitoring')->nullable();
            $table->timestamps();

            $table->foreign('detail_ket_sub_dpa_id')->references('id')
                ->on('detail_ket_sub_dpa')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rencana_pembangunan');
    }
}
