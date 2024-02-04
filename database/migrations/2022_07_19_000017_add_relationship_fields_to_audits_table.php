<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAuditsTable extends Migration
{
    public function up()
    {
        Schema::table('audits', function (Blueprint $table) {
            $table->unsignedBigInteger('lastname_id')->nullable();
            $table->foreign('lastname_id', 'lastname_fk_6943083')->references('id')->on('list_of_names');
            $table->unsignedBigInteger('firstname_id')->nullable();
            $table->foreign('firstname_id', 'firstname_fk_6943084')->references('id')->on('list_of_names');
        });
    }
}
