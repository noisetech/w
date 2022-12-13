<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKetSubDpaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ket_sub_dpa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_dpa_id');
            $table->foreignId('akun');
            $table->foreignId('kelompok');
            $table->foreignId('jenis');
            $table->foreignId('objek');
            $table->foreignId('rincian_objek');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('sub_dpa_id')->references('id')
                ->on('sub_dpa')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->foreign('akun')->references('id')
                ->on('akun_rekening')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('kelompok')->references('id')
                ->on('kelompok_rekening')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('jenis')->references('id')
                ->on('jenis_rekening')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->foreign('objek')->references('id')
                ->on('objek_rekening')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->foreign('rincian_objek')->references('id')
                ->on('rincian_objek_rekening')
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
        Schema::dropIfExists('ket_sub_dpa');
    }
}
