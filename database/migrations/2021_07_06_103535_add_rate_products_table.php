<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('description',200);
            $table->string('image',300);
            $table->tinyInteger('status');
            $table->integer('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('rate');
            $table->dropColumn('description');
            $table->dropColumn('image');
            $table->dropColumn('status');
            $table->dropColumn('amount');
        });
    }
}
