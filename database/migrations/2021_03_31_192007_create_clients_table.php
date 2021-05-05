<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom', 60);
            $table->string('prenom', 70);
            $table->string('telephone',13)->unique();
            $table->string('email', 70)->unique();
            $table->string('sexe');
            $table->string('adresse', 250)->nullable();
            $table->string('num_carte_identite')->unique();
            $table->string('etat')->default('1');
            $table->unsignedInteger('pointdeventes_id');
            $table->foreign('pointdeventes_id')->references('id')->on('pointdeventes')->onDelete('cascade');
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
        Schema::dropIfExists('clients');
    }
}
