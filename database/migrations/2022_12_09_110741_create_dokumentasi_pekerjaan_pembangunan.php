<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumentasiPekerjaanPembangunan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumentasi_pekerjaan_pembangunan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('det_rencana_pembangunan');
            $table->text('dokumentasi');
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
        Schema::dropIfExists('dokumentasi_pekerjaan_pembangunan');
    }
}
