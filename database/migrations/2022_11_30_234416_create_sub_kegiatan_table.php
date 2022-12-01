<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id');
            $table->foreignId('satuan_id');
            $table->longText('kode');
            $table->longText('nomenklatur');
            $table->longText('kinerja');
            $table->longText('indikator');
            $table->timestamps();

            $table->foreign('kegiatan_id')->references('id')
                ->on('kegiatan')
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
        Schema::dropIfExists('sub_kegiatan');
    }
}
