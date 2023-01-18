<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailFinishedMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_finished_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('finished_material_id');
            $table->integer('quantity');
            $table->float('price');
            $table->timestamps();

            $table->foreign('finished_material_id')->on('finished_materials')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_finished_materials');
    }
}
