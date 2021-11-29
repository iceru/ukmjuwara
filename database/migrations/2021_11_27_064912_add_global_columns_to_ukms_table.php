<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGlobalColumnsToUkmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ukms', function (Blueprint $table) {
            $table->text('minimum_order')->nullable();
            $table->text('fulfillment_duration')->nullable();
            $table->text('preferred_incoterm')->nullable();
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
            $table->dropColumn('minimum_order');
            $table->dropColumn('fulfillment_duration');
            $table->dropColumn('preferred_incoterm');
        });
    }
}
