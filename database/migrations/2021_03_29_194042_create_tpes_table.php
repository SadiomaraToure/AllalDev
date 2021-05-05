<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTpesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tpes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn');
            $table->string('login');
            $table->string('pwd');
            $table->unsignedInteger('pointdeventes_id');
            $table->foreign('pointdeventes_id')->references('id')->on('pointdeventes')->onDelete('cascade');
            $table->integer('etat')->default(1);
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
        Schema::dropIfExists('tpes');
    }
}
