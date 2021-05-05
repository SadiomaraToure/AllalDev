<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAscsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ascs', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 80);
            $table->string('telephone',13);
            $table->string('email', 70)->unique();
            $table->string('adresse', 250)->nullable();
            $table->unsignedInteger('zones_id');
            $table->foreign('zones_id')->references('id')->on('zones')->onDelete('cascade');
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
        Schema::dropIfExists('ascs');
    }
}
