<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogueCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('catalogue_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_icon');
            $table->string('category_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
