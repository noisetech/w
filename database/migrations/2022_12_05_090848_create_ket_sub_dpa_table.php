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
            $table->bigInteger('akun');
            $table->bigInteger('kelompok');
            $table->bigInteger('jenis');
            $table->bigInteger('objek');
            $table->bigInteger('rincian_objek');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('sub_dpa_id')->references('id')
                ->on('sub_dpa')
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
