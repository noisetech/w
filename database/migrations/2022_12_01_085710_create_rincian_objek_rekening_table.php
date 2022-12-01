<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRincianObjekRekeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rincian_objek_rekening', function (Blueprint $table) {
            $table->id();
            $table->foreignId('objek_rekening_id');
            $table->string('kode');
            $table->text('uraian_akun')->nullable();
            $table->text('deskripsi_akun')->nullable();
            $table->timestamps();

            $table->foreign('objek_rekening_id')->references('id')
                ->on('objek_rekening')
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
        Schema::dropIfExists('rincian_objek_rekening');
    }
}
