<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoreServicesTable extends Migration
{
    public function up()
    {
        Schema::create('core_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('service_name');
            $table->longText('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
