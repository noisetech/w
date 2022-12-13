<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetRencanaPembangunan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_rencana_pembangunan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('rencana_pembangunan_id')->nullable();
            $table->foreignId('komponen_pembangunan_id')->nullable();
            $table->integer('volume')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('harga')->nullable();
            $table->integer('persentase')->nullable();
            $table->enum('riil', ['sudah', 'belum'])->nullable();
            $table->longText('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('rencana_pembangunan_id')->references('id')
                ->on('rencana_pembangunan')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('komponen_pembangunan_id')->references('id')
                ->on('komponen_pembangunan')
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
        Schema::dropIfExists('det_rencana_pembangunan');
    }
}
