<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListOfNamesTable extends Migration
{
    public function up()
    {
        Schema::create('list_of_names', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('house_number');
            $table->string('last_name');
            $table->string('first_name')->nullable();
            $table->string('middle_initial')->nullable();
            $table->string('customers_number')->nullable();
            $table->string('meter_number');
            $table->string('installation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
