<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUkmIdToClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clicks', function (Blueprint $table) {
            $table->unsignedBigInteger('ukm_id')->nullable();
            $table->foreign('ukm_id')->references('id')->on('ukms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clicks', function (Blueprint $table) {
            $table->dropColumn('ukm_id');
        });
    }
}
