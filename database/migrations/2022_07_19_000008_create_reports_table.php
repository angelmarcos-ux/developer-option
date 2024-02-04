<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('middle_name')->nullable();
            $table->date('last_payment_date');
            $table->integer('balance')->nullable();
            $table->integer('bill_paid')->nullable();
            $table->string('paid_pending')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
