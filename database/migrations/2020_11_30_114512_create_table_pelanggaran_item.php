<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePelanggaranItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggaran_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelanggaran_id');
            $table->unsignedBigInteger('pasal_id');
            $table->decimal('denda', 10, 2);
            $table->timestamps();

            $table->foreign('pelanggaran_id')->references('id')->on('pelanggaran');
            $table->foreign('pasal_id')->references('id')->on('pasal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelanggaran_item');
    }
}
