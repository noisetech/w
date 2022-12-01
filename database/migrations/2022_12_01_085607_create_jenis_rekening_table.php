<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisRekeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_rekening', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelompok_rekening_id');
            $table->string('kode');
            $table->text('uraian_akun')->nullable();
            $table->text('deskripsi_akun')->nullable();
            $table->timestamps();

            $table->foreign('kelompok_rekening_id')->references('id')
                ->on('kelompok_rekening')
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
        Schema::dropIfExists('jenis_rekening');
    }
}
