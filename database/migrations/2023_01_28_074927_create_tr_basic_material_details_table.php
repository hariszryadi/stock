<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrBasicMaterialDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_basic_material_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tr_basic_material_id');
            $table->integer('basic_material_id');
            $table->integer('qty');
            $table->timestamps();

            $table->foreign('tr_basic_material_id')->on('tr_basic_materials')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_basic_material_details');
    }
}
