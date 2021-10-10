<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUkmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ukms', function (Blueprint $table) {
            $table->string('owner_gender');
            $table->string('achievement')->nullable();
            $table->string('operational_hours')->nullable();
            $table->string('permission')->nullable();
            $table->string('capacity')->nullable();
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
            $table->dropColumn('owner_gender');
            $table->dropColumn('achievement');
            $table->dropColumn('operational_hours');
            $table->dropColumn('permission');
            $table->dropColumn('capacity');
        });
    }
}
