<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCataloguDatasTable extends Migration
{
    public function up()
    {
        Schema::table('catalogu_datas', function (Blueprint $table) {
            $table->unsignedBigInteger('catalogue_category_id')->nullable();
            $table->foreign('catalogue_category_id', 'catalogue_category_fk_10717351')->references('id')->on('catalogue_categories');
        });
    }
}
