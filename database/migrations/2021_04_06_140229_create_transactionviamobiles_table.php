<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionViaMobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactionviamobiles', function (Blueprint $table) {
            $table->increments('id');
            $table->float('montant');
            $table->float('frais');
            $table->string('type_transaction');
            $table->string('date_transaction');
            //id du compte du client émitrice de la transaction
            $table->unsignedInteger('comptes_id');
            $table->foreign('comptes_id')->references('id')->on('comptes'); 

            //id du compte du client destinateur de la transaction
            $table->unsignedInteger('telephone');
            $table->foreign('telephone')->references('telephone')->on('clients')->onDelete('cascade');
            
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
        Schema::dropIfExists('transactionviamobiles');
    }
}
