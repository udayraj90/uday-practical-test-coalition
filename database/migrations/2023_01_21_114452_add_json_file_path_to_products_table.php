<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJsonFilePathToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasTable('products')) {
            Schema::table('products', function (Blueprint $table) {
                $table->mediumText('jsonFileName')->after("pricePerUnit");
                $table->mediumText('jsonFileNameURL')->after("jsonFileName");
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('products')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('jsonFileName');
                $table->dropColumn('jsonFileNameURL');
            });
        }
    }
}
