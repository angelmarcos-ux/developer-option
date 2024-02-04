<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationReportsTable extends Migration
{
    public function up()
    {
        Schema::create('information_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('info_reports');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
