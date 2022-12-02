<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubDpa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_dpa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dpa_id');
            $table->foreignId('sub_kegiatan_id');
            $table->foreignId('sumber_dana');
            $table->text('lokasi');
            $table->integer('target');
            $table->string('waktu_pelaksanaan');
            $table->text('keterangan');
            $table->softDeletes();
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
        Schema::dropIfExists('sub_dpa');
    }
}
