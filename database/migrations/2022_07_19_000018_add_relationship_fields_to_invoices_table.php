<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInvoicesTable extends Migration
{
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('last_name_id')->nullable();
            $table->foreign('last_name_id', 'last_name_fk_7012413')->references('id')->on('list_of_names');
            $table->unsignedBigInteger('first_name_id')->nullable();
            $table->foreign('first_name_id', 'first_name_fk_7012414')->references('id')->on('list_of_names');
        });
    }
}
