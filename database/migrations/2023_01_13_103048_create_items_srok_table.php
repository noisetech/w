<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsSrokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_srok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_rincian_objek_rekening_id');
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('sub_rincian_objek_rekening_id')->references('id')
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
        Schema::dropIfExists('items_srok');
    }
}
