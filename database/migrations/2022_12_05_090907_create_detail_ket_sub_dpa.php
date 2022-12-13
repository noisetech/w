<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKetSubDpa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_ket_sub_dpa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ket_sub_dpa_id');
            $table->foreignId('sub_rincian_objek')->nullable();
            $table->integer('jumlah_anggaran')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('ket_sub_dpa_id')->references('id')
                ->on('ket_sub_dpa')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('sub_rincian_objek')->references('id')
                ->on('sub_rincian_objek_rekening')
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
        Schema::dropIfExists('detail_ket_sub_dpa');
    }
}
