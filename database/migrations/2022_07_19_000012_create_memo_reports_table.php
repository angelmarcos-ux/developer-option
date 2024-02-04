<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemoReportsTable extends Migration
{
    public function up()
    {
        Schema::create('memo_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('memo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
