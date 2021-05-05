<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
           
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
    
                $table->string('telephone',16)->unique();
                $table->string('sexe');
                $table->string('adresse', 250)->nullable();
                $table->string('num_carte_identite')->unique();
                $table->string('profil', 10)->default('clt');
    
                $table->string('etat')->default('1');
                
                // $table->unsignedInteger('pointdeventes_id');
                // $table->foreign('pointdeventes_id')->references('id')->on('pointdeventes')->onDelete('cascade');
    
                $table->timestamp('email_verified_at')->nullable();
                $table->rememberToken();
                $table->foreignId('current_team_id')->nullable();
                $table->text('profile_photo_path')->nullable();
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
        Schema::dropIfExists('users');
    }
}
