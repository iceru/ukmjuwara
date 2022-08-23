<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClicksToSlidersUkm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ukm_sliders', function (Blueprint $table) {
            $table->integer('clicks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ukm_sliders', function (Blueprint $table) {
            $table->dropColumn('clicks');
        });
    }
}
