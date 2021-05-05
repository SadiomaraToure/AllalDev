<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionserviceviatpesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactionserviceviatpes', function (Blueprint $table) {
            $table->increments('id');
            $table->float('montant');
            $table->float('frais');
            $table->string('ref_facture');
            $table->string('type_transaction');
            $table->string('date_transaction');

            //id entreprise concernée (paiement services)
            $table->unsignedInteger('entreprise_id');
            $table->foreign('entreprise_id')->references('id')->on('entreprises')->onDelete('cascade');

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
        Schema::dropIfExists('transactionserviceviatpes');
    }
}
