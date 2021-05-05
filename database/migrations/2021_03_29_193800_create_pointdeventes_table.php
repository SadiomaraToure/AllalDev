<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointdeventesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pointdeventes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('adresse');
            $table->unsignedInteger('ascs_id');
            $table->foreign('ascs_id')->references('id')->on('ascs')->onDelete('cascade');
            $table->unsignedInteger('admins_id'); 
            $table->foreign('admins_id')->references('id')->on('admins')->onDelete('cascade');
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
        Schema::dropIfExists('pointdeventes');
    }
}
