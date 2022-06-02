<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMinMaxPriceToUkms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ukms', function (Blueprint $table) {
            $table->integer('min_price');
            $table->integer('max_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ukms', function (Blueprint $table) {
            $table->dropColumn('min_price');
            $table->dropColumn('max_price');
        });
    }
}
