<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchatticketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achattickets', function (Blueprint $table) {
            $table->increments('id');
            
            $table->double('montant', 6);
            $table->string('qr_code',500);
            $table->string('email_acheteur', 50);
            
            
            $table->unsignedInteger('evenement_id');
            $table->foreign('evenement_id')->references('id')->on('evenements')->onDelete('cascade');
            $table->unsignedInteger('pointdevente_id');
            $table->foreign('pointdevente_id')->references('id')->on('pointdeventes')->onDelete('cascade');
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
        Schema::dropIfExists('achattickets');
    }
}
