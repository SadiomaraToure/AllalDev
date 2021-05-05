<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionviatpesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactionviatpes', function (Blueprint $table) {
            $table->increments('id');
            $table->float('montant');
            $table->float('frais');
            $table->string('type_transaction');
            $table->string('date_transaction');

            //id carte concernée (Dépôt ou retrait)
            $table->unsignedInteger('cartes_id');
            $table->foreign('cartes_id')->references('id')->on('cartes')->onDelete('cascade');

            //id tpe qui a fait la transaction
            $table->unsignedInteger('tpes_id');
            $table->foreign('tpes_id')->references('id')->on('tpes')->onDelete('cascade');

            $table->string('etat')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactionviatpes');
    }
}
