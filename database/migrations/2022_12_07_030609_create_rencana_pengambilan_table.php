<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaPengambilanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_pengambilan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dpa_id');
            $table->text('rencana_pengambilan')->nullable();
            $table->text('catatan')->nullable();
            $table->string('realisasi')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('dpa_id')->references('id')->on('ket_sub_dpa')
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
        Schema::dropIfExists('rencana_pengambilan');
    }
}
