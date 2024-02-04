<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReportsTable extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->unsignedBigInteger('lastname_id')->nullable();
            $table->foreign('lastname_id', 'lastname_fk_6942942')->references('id')->on('list_of_names');
            $table->unsignedBigInteger('first_name_id')->nullable();
            $table->foreign('first_name_id', 'first_name_fk_6942943')->references('id')->on('list_of_names');
        });
    }
}
