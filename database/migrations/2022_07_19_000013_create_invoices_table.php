<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name')->nullable();
            $table->string('serial_number')->nullable();
            $table->date('date');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('prev_reading')->nullable();
            $table->string('present_reading')->nullable();
            $table->integer('water_usage')->nullable();
            $table->string('price_per_cb')->nullable();
            $table->string('discount')->nullable();
            $table->string('system_lost')->nullable();
            $table->string('total_amount')->nullable();
            $table->longText('note')->nullable();
            $table->date('get_pay_until_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
