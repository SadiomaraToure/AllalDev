<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvenementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom_evenement', 200);
            $table->string('date_evenement', 20);
            $table->string('liste_asc', 100);
            $table->string('lieu_evenement',120);
            $table->double('prix_ticket1', 6);
            $table->double('prix_ticket2', 6)->nullable();
            $table->double('prix_ticket3', 6)->nullable();
            $table->double('prix_ticket4', 6)->nullable();
           
            
            $table->unsignedInteger('zone_id');
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
            $table->unsignedInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
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
        Schema::dropIfExists('evenements');
    }
}
