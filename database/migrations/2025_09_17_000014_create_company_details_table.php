<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('company_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('company_name');
            $table->string('gst_number');
            $table->string('company_phone_number');
            $table->string('other_phone_number')->nullable();
            $table->longText('google_map_link');
            $table->string('email');
            $table->string('other_email')->nullable();
            $table->longText('office_address');
            $table->longText('company_facebook_link')->nullable();
            $table->longText('comapnay_instagram_link')->nullable();
            $table->longText('company_linkedin_link')->nullable();
            $table->longText('company_youtube_link')->nullable();
            $table->string('company_x_link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
