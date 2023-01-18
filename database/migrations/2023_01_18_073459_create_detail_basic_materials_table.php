<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBasicMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_basic_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('basic_material_id');
            $table->integer('quantity');
            $table->float('price');
            $table->timestamps();

            $table->foreign('basic_material_id')->on('basic_materials')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_basic_materials');
    }
}
