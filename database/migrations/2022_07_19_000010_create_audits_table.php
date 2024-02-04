<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('middle_initial')->nullable();
            $table->string('suffix')->nullable();
            $table->integer('bill_paid')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
