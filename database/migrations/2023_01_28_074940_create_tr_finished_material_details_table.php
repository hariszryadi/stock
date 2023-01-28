<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrFinishedMaterialDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_finished_material_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tr_finished_material_id');
            $table->integer('finished_material_id');
            $table->integer('qty');
            $table->timestamps();

            $table->foreign('tr_finished_material_id')->on('tr_finished_materials')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_finished_material_details');
    }
}
