<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryColumnToTrBasicMaterials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Pembelian
        // 2. Retur
        // 3. Penjualan
        // 4. Rusak
        Schema::table('tr_basic_materials', function (Blueprint $table) {
            $table->string('category', 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_basic_materials', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
}
