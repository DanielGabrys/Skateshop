<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSaleNewAttributesToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_on_sale');
            $table->decimal('sale_price',10,2);
            $table->integer('sale_percent');
            $table->dateTime('sale_valid_date')->nullable($value = true);
            $table->boolean('is_new');
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
            $table->dropColumn('is_on_sale');
            $table->dropColumn('sale_price');
            $table->dropColumn('sale_percent');
            $table->dropColumn('sale_valid_date');
            $table->dropColumn('is_new');
        });
    }
}
