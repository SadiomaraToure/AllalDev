<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionserviceviamobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactionserviceviamobiles', function (Blueprint $table) {
            $table->increments('id');
            $table->float('montant');
            $table->float('frais');
            $table->string('type_transaction');
            $table->string('date_transaction');
            //id du compte du client émétrice de la transaction
            $table->unsignedInteger('comptes_id');
            $table->foreign('comptes_id')->references('id')->on('comptes')->onDelete('cascade');

            //id entreprise destinataire de la transaction(paiement service)
            $table->unsignedInteger('entreprise_id');
            $table->foreign('entreprise_id')->references('id')->on('entreprises')->onDelete('cascade');

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
        Schema::dropIfExists('transactionserviceviamobiles');
    }
}
