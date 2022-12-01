<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjekRekeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_rekening', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_rekening_id');
            $table->string('kode');
            $table->text('uraian_akun')->nullable();
            $table->text('deskripsi_akun')->nullable();
            $table->timestamps();

            $table->foreign('jenis_rekening_id')->references('id')
                ->on('jenis_rekening')
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
        Schema::dropIfExists('objek_rekening');
    }
}
